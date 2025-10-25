<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateRequest;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Models\Admin;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('user'));
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
        //
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
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        // dd($request->all());
        $admin = Admin::findOrFail($id);

        if ($request->has('image')) {
            $path = 'uploads/admin/profile';
            $oldPath = $request->input('old_image');
            $newImagePath = $this->updateImage($request, 'image', $path, $oldPath);
            $admin->image = $newImagePath;
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();
        toast(__('Profile updated successfully!'), __('success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Profile Password Update 
    function passwordUpdate(AdminPasswordUpdateRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        if (!Hash::check($request->old_password, $admin->password)) {
            throw ValidationException::withMessages([
                'old_password' => __('Old password is incorrect.'),
            ]);
        }

        $admin->password = bcrypt($request->new_password);
        $admin->save();

        toast(__('Password updated successfully!'), __('success'));

        return redirect()->back();
    }
}
