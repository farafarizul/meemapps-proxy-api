<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function index()
    {
        $settings = AppSetting::orderBy('key')->get();
        return view('admin.app-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        foreach ($settings as $key => $value) {
            AppSetting::where('key', $key)->update(['value' => $value]);
        }
        return redirect()->route('admin.app-settings.index')->with('success', 'Settings updated.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:app_settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:string,json,boolean,integer',
            'label' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        AppSetting::create($request->only('key', 'value', 'type', 'label', 'description'));
        return redirect()->route('admin.app-settings.index')->with('success', 'Setting created.');
    }

    public function destroy(AppSetting $appSetting)
    {
        $appSetting->delete();
        return redirect()->route('admin.app-settings.index')->with('success', 'Setting deleted.');
    }
}
