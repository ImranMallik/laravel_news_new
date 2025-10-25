<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;

    function index()
    {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'site_name' => ['required', 'max:255'],
            'site_logo' => ['nullable', 'image', 'max:3000'],
            'site_favicon' => ['nullable', 'image', 'max:1000']
        ]);

        $data = [
            'site_name' => $request->input('site_name'),
        ];

        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $this->uploadImage($request, 'site_logo', 'uploads/settings');
        }

        if ($request->hasFile('site_favicon')) {
            $data['site_favicon'] = $this->uploadImage($request, 'site_favicon', 'uploads/settings');
        }

        Setting::createOrUpdate($data);

        toast(__('Settings updated successfully.'), 'success');

        return redirect()->back();
    }


    public function updateSeoSetting(Request $request)
    {
        $request->validate([
            'seo_title'       => 'required|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords'    => 'nullable|string',
        ]);

        $data = [
            'seo_title'       => $request->input('seo_title'),
            'seo_description' => $request->input('seo_description'),
            'seo_keywords'    => $request->input('seo_keywords'),
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        toast(__('SEO Settings updated successfully.'), 'success');

        return redirect()->back();
    }
}
