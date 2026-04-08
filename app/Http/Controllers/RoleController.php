<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all());
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = \App\Models\Role::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Role created',
            'data' => $role
        ]);
    }
    public function destroy($id)
    {
        $role = \App\Models\Role::findOrFail($id);

        if ($role->users()->count() > 0) {
            return response()->json([
                'status' => false,
                'message' => 'Role masih dipakai user'
            ], 400);
        }

        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Role deleted'
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Role updated',
            'data' => $role
        ]);
    }
}
