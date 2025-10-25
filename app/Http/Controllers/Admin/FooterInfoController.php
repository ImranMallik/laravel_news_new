<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Models\Language;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class FooterInfoController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.footer-info.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'language' => ['required', 'exists:languages,lang'],
            'short_description' => ['required', 'max:300'],
            'copy_right' => ['required', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3000'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $this->uploadImage($request, 'logo', 'uploads/footer');
        }

        FooterInfo::updateOrCreate(
            ['language' => $request->language],
            [
                'logo' => $logoPath,
                'description' => $request->short_description,
                'copyright' => $request->copy_right,
                'language' => $request->language,
            ]
        );

        toast(__('Updated Successfully'), 'success');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
