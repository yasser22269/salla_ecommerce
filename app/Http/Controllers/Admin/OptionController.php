<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\OptionTranslation;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Options = Option::with('product','attribute')->paginate(PAGINATION_COUNT);
        return view('Admin.Options.index', compact('Options'));
    }

    public function GetOptions(){
        $data = Option::with('product','attribute')->get();


        if ($data->isEmpty()) {
            return response()->json(['message' => 'No Options found.'], 404);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('product', function($row){
                return $row->product->name ?? "--";
            })
            ->addColumn('attribute', function($row){
                return $row->attribute->name ?? "--";
            })
            ->addColumn('price', function($row){
                return $row->price;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div style="display: flex;justify-content: flex-start;">
                       <a href="'.route('Options.edit',$row->id).'" class="mr-1 btn btn-info btn-sm round  box-shadow-2 px-1">
                                Edit
                            </a>
             <form class="form" method="POST" action="'. route('Options.destroy',$row->id) .'">
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
            ->rawColumns(['action','name','price','product','attribute'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        $attrubutes = Attribute::get();
        return view('Admin.Options.create', compact('attrubutes', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        try {
            DB::beginTransaction();
            $Option =  Option::create($request->except('_token'));

            //save translations
            // $Option->name = $request->name;
            //  $Option->save();

            // return $Option;
            DB::commit();
            return redirect()->route('Options.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $Option
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Option = Option::findOrFail($id);
        $products = Product::get();
        $attrubutes = Attribute::get();
        return view('Admin.Options.edit', compact("Option", 'attrubutes', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $Option
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Option = Option::find($id);


            // return $request;
            $Option->update($request->all());

            //save translations
            // $Option->name = $request->name;
            // $Option->save();


            DB::commit();
            return redirect()->route('Options.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Options.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        $Option = Option::find($id);
        if (!$Option)
            return redirect()->route('Options.index')->with(['error' => 'هذا الاوبشن غير موجود ']);

        $Option->delete();
        return redirect()->route('Options.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
