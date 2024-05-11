<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\AttributeTranslation;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{

    public function index()
    {
        $attributes = Attribute::paginate(PAGINATION_COUNT);
        return view('Admin.attributes.index', compact('attributes'));
    }


    public function GetAttributes(){
        $data = Attribute::get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No Attributes found.'], 404);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div style="display: flex;justify-content: flex-start;">
                       <a href="'.route('Attributes.edit',$row->id).'" class="mr-1 btn btn-info btn-sm round  box-shadow-2 px-1">
                                Edit
                            </a>
             <form class="form" method="POST" action="'. route('Attributes.destroy',$row->id) .'">
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
            ->rawColumns(['action','name'])
            ->make(true);
    }


    public function create()
    {
        return view('Admin.attributes.create');
    }


    public function store(AttributeRequest $request)
    {
        try {

            DB::beginTransaction();
            $Attribute =  Attribute::create($request->except('_token'));

            //save translations
            //  $Attribute->name = $request->name;
            // $Attribute->save();

            // return $Attribute;
            DB::commit();
            return redirect()->route('Attributes.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Attributes.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {
        $Attribute = Attribute::findOrFail($id);
        return view('Admin.attributes.edit', compact("Attribute"));
    }


    public function update(AttributeRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Attribute = Attribute::find($id);

            // return $request;
            $Attribute->update($request->all());

            //save translations
            //  $Attribute->name = $request->name;
            //  $Attribute->save();


            DB::commit();
            return redirect()->route('Attributes.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Attributes.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        $Attribute = Attribute::find($id);
        if (!$Attribute)
            return redirect()->route('Attributes.index')->with(['error' => 'هذا صفة غير موجود ']);

        $Attribute->delete();
        return redirect()->route('Attributes.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
