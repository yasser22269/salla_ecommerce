<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //translatedIn(app() -> getLocale())->
        $categories = Category::paginate(PAGINATION_COUNT);
        return view('admin.categories.index', compact('categories'));
    }

    public function GetCategories(){
        $data = Category::with('Parent')->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No Categories found.'], 404);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('Parent', function($row){
                return $row->Parent->name ?? '--';
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div style="display: flex;justify-content: flex-start;">
                       <a href="'.route('Category.edit',$row->id).'" class="btn btn-info btn-sm round  box-shadow-2 px-1">
                                Edit
                            </a>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['Parent','action','name'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesParent = Category::select('name','id')->whereNull('parent_id')->get();
        $categories = Category::with('children.children')->whereNull('parent_id')->get();

        return view('admin.categories.create', compact('categories', 'categoriesParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            if (isset($request->status) && $request->status == 1)
                $request->request->add(['status' => 1]);
            else
                $request->request->add(['status' => 0]);

            //parent
            if (!isset($request->parent_id) || $request->type == 1)
                $request->request->add(['parent_id' => null]);


            //   return $request->except('_token','type');
            $Category =  Category::create($request->except('_token', 'type'));


            //save translations
            // $Category->name = $request->name;
            //$Category->save();

            // return $Category;
            DB::commit();
            return redirect()->route('Category.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::with('children.children')->whereNull('parent_id')->get();
        $categoriesParent = Category::select('id')->Parent()->get();


        return view('Admin.categories.edit', compact('categories', "category", 'categoriesParent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $Category = Category::find($id);
            if (isset($request->status) && $request->status == 1)
                $request->request->add(['status' => 1]);
            else
                $request->request->add(['is_active' => 0]);


            if (!isset($request->parent_id) || $request->type == 1)
                $request->request->add(['parent_id' => null]);


            // return $request;
            $Category->update($request->except('_token', 'type'));
            //save translations
            // $Category->name = $request->name;
            // $Category->save();


            DB::commit();
            return redirect()->route('Category.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
