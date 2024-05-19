<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSpecialPriceRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductSpecialImageRequest;
use App\Http\Requests\ProductSpecialStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\ManageStock;
use App\Models\Offer;
use App\Models\ProductTranslation;
use App\Models\Tag;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(PAGINATION_COUNT);
        return view('Admin.products.index', compact('products'));
    }

    public function GetProducts(){
        $data = Product::with('category')->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No Products found.'], 404);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('price', function($row){
                return $row->price;
            })
            ->addColumn('viewed', function($row){
                return $row->viewed;
            })
            ->addColumn('category', function($row){
                return $row->category->name;
            })
            ->addColumn('quantity_available', function($row){
                return $row->quantity_available ?? '--';
            })
            ->addColumn('status', function($row){
                return $row->getActive();
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div style="display: flex;justify-content: flex-start;">
                       <a href="'.route('Products.edit',$row->id).'" class="btn btn-info btn-sm round  box-shadow-2 px-1">
                                Edit
                        </a>

                            <form class="form" method="POST" action="'. route('Products.destroy',$row->id) .'">
                     '. csrf_field()  .'
                     '. method_field('DELETE')  .'
                          <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" >
                            DELETE
                          </button>

                      </form>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['price','viewed','category','status','quantity_available','action','name'])
            ->make(true);
    }


    public function create()
    {
        $categories = Category::get();
//        $tags = Tag::translatedIn(app()->getLocale())->get();
//        $brands = Brand::translatedIn(app()->getLocale())->get();
        // return $categories ;
        return view('Admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->request->add(['slug' => \Str::slug($request->slug)]);

            // return $request->except('_token','type');
            $Product =  Product::create($request->except('_token', 'photo'));

            // Relations
            //$Product->category()->attach($request->categories);
            //$Product->tags()->attach($request->tags);

//            ManageStock::create([
//                'qty' => Null,
//                'in_stock' => 0,
//                'sku' => Null,
//                'manage_stock' => 0,
//                'product_id' => $Product->id,
//            ]);
//            Offer::create([
//                'special_price_type' => Null,
//                'special_price_start' => Null,
//                'special_price_end' => Null,
//                'special_price' => Null,
//                'product_id' => $Product->id,
//            ]);



            $fileName = uploadImage('products', $request->photo);
            Image::create([
                'imageable_id' => $Product->id,
                'imageable_type' => Product::class,
                'filename' => $fileName,
                'path' => 'images/products',
                "caption" => 'Product Image'
            ]);

            //save translations
            // $Product->name = $request->name;
            // $Product->short_description = $request->short_description;
            // $Product->description = $request->description;
            $Product->save();

            // return $Product;
            DB::commit();
            return redirect()->route('Products.edit', $Product->id)->with(['success' => ' تم ألاضافة بنجاح يجب اضافه باقى الخصائص']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {
        $Product = Product::with('category:id','images')->findOrFail($id);
        $offer = Offer::where('product_id', $Product->id)->first();
//        $ManageStock = ManageStock::where('product_id', $Products->id)->first();
        //return $offers;

        $categories = Category::get();
//        $tags = Tag::translatedIn(app()->getLocale())->get();
//        $brands = Brand::translatedIn(app()->getLocale())->get();

         //  return $Product ;
        return view('Admin.products.edit', compact('categories', 'offer',"Product"));
    }


    public function update(ProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $Product = Product::find($id);
            if (isset($request->status) && $request->status == 1)
                $request->request->add(['status' => 1]);
            else
                $request->request->add(['status' => 0]);

            $request->request->add(['slug' => \Str::slug($request->slug)]);

            //  return $request->except('_token');
            $Product->update($request->except('_token'));

            // Relations
            //$Product->category()->sync($request->categories);
            //$Product->tags()->sync($request->tags);

            //save translations
            // $Product->name = $request->name;
            // $Product->short_description = $request->short_description;
            // $Product->description = $request->description;
            // $Product->save();


            DB::commit();
            return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.edit', $Product->id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    // ProductPriceRequest  Request

    public function Priceupdate(ProductSpecialPriceRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $offer = Offer::where('product_id', $id)->first();
            if($offer)
                $offer->update($request->except('_method', "_token"));
            else
                Offer::create($request->except('_method', "_token"));


            DB::commit();
            return redirect()->route('Products.edit', $id)->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.edit', $id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

//    public function stockupdate(ProductSpecialStockRequest $request, $id)
//    {
//        try {
//            DB::beginTransaction();
//            $ManageStock = ManageStock::where('product_id', $id)->first();
//            $ManageStock->update($request->except('_method', "_token"));
//
//            DB::commit();
//            return redirect()->route('Products.edit', $id)->with(['success' => 'تم التعديل بنجاح']);
//        } catch (\Exception $ex) {
//            DB::rollback();
//            return redirect()->route('Products.edit', $id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
//    }

    public function imageupdateDB(ProductSpecialImageRequest $request, $id)
    {
        try {
            if ($request->has('filename') && count($request->filename) > 0) {
                foreach ($request->filename as $image) {
                    $photo = uploadImage('products', $image);
                    Image::create([
                        'imageable_id' => $id,
                        'imageable_type' => Product::class,
                        'filename' => $photo,
                        'path' => 'images/products',
                        "caption" => 'Product Image'
                    ]);
                }
            }
            return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }


    public function imagedeleteId(Request $request, $id)
    {

        $ImageProduct = Image::find($id);

        if (File::exists($ImageProduct->path . "/" .$ImageProduct->filename)) {
            File::delete($ImageProduct->path . "/" .$ImageProduct->filename);
        }
        $ImageProduct->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }

    public function destroy($id)
    {
        $Product = Product::find($id);
        $images= $Product->images;
        $Offer= $Product->Offer;
        if ($Offer)
            $Offer->delete();

        if ($images){
            foreach ($images as $image) {
                if (File::exists($image->path . "/" . $image->filename)) {
                    File::delete($image->path . "/" . $image->filename);
                }
                $image->delete();
            }
        }


        if (!$Product)
            return redirect()->route('Products.index')->with(['error' => 'هذا الماركة غير موجود ']);


        $Product->delete();
        return redirect()->route('Products.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
