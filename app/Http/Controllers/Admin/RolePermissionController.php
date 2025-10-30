<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    //

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('group_name');
        // dd($permissions);
        return  view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'max:50', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
        ]);

        $role = Role::create(['guard_name' => 'admin', 'name' => $request->role]);

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        toast(__('Created Successfully'), 'success');

        return redirect()->route('admin.role.index');
    }

    public function edit($id)
    {
        // dd('hi');
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('group_name');

        return view('admin.role.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => ['required', 'max:50', 'unique:roles,name,' . $id],
            'permissions' => ['nullable', 'array'],
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->role;
        $role->save();

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        toast(__('Updated Successfully'), 'success');

        return redirect()->route('admin.role.index');
    }


    public function delete(string $id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'Super Admin') {
            return response([
                'status' => 'error',
                'message' => __('Can\'t delete the Super Admin')
            ]);
        }

        $role->delete();

        return response([
            'status' => 'success',
            'message' => __('Deleted successfully!')
        ]);
    }
}
