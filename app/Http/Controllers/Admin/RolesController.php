<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaveRolesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Role);

        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $role = new Role);

        return view('admin.roles.create', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\SaveRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolesRequest $request)
    {
        $this->authorize('create', new Role);

        $role = Role::create($request->validated());

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('exito', 'El rol fue creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role  $role)
    {
        $this->authorize('update', $role);

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\SaveRolesRequest  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolesRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $role->update($request->validated());

        $role->permissions()->detach();

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.edit', $role)
                        ->with('exito', 'El rol fue actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role  $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('admin.roles.index')
                        ->with('exito', 'El rol ha sido eliminado.');
    }
}
