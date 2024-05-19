<?php

namespace App\Http\Controllers\Admin;


use  App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use App\Models\ContactUS;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    public function index()
    {
        $produtctCount = Product::count();
        $OrderCount = Order::count();
        $UserCount = User::count();
        $ContactUSCount = ContactUS::count();
        return view('Admin.index', compact('produtctCount', 'OrderCount', 'UserCount', 'ContactUSCount'));
    }


    public function indexAdmins()
    {
        return view('Admin.admins.index');
    }

    public function getAdmins()
    {
        $data = Admin::all();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No Admins found.'], 404);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('email', function($row){
                return $row->email;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div style="display: flex;justify-content: flex-start;">
                     <form class="form" method="POST" action="'. route('admin.indexAdmins.destroy',$row->id) .'">
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
            ->rawColumns(['email','action','name'])
            ->make(true);
    }


    public function profile()
    {
        $admin = auth('admin')->user();
        // Auth()->guard('admin')->user()
        return view('Admin.profile.index', compact('admin'));
    }


    public function updateprofile(AdminProfileRequest $request, $id)
    {

        $admin = Admin::findOrfail($id);
        // return $request;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if (isset($request['password']) && $request['password'] != '') {
            $admin->password = bcrypt($request['password']);
        }
        $admin->save();

        // DB::commit();
        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminProfileRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['password'] = bcrypt($request['password']);
            Admin::create($request->except('_token','password_confirmation'));
            DB::commit();
            return redirect()->route('admin.Admins.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        $Admin = Admin::find($id);
        if (!$Admin)
            return redirect()->back()->with(['error' => 'هذا العضو غير موجود ']);

        $Admin->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }
}
