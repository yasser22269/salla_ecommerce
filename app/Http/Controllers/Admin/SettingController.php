<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodsRequest;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    // Display a listing of the settings
    public function index()
    {
        $settings = Setting::all();
        return view('admin.Settings.index',compact('settings'));
    }

    // Store a newly created setting in storage
    public function store(Request $request)
    {
        $validator =  $request->validate([
            'key' => 'required|unique:settings|max:255',
            'value' => 'required',
        ]);

        $setting = new Setting([
            'key' => $request->get('key'),
            'value' => $request->get('value'),
        ]);

        $setting->save();
        return redirect()->back()->with(['success' => 'Setting created!']);
    }

    // Display the specified setting
    public function show($id)
    {
        $setting = Setting::find($id);
        return response()->json($setting);
    }

    // Update the specified setting in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => 'required|max:255|unique:settings,key,' . $id,
            'value' => 'required',
        ]);

        $setting = Setting::find($id);
        $setting->key = $request->get('key');
        $setting->value = $request->get('value');
        $setting->save();
        return redirect()->back()->with(['success' => 'Setting updated!']);
    }

    // Remove the specified setting from storage
    public function destroy($id)
    {
        $setting = Setting::find($id);
        $setting->delete();
        return redirect()->back()->with(['success' => 'Setting deleted!']);
    }

    // Display a setting by key
    public function showByKey($key)
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting) {
            return response()->json($setting);
        } else {
            return response()->json(['message' => 'Setting not found'], 404);
        }
    }

    //             return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    //             return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);

}
