<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Events\UserWasCreated;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = new User;
        $permissions = Permission::pluck('name', 'id');
        $roles = Role::with('permissions')->get();
        return view('admin.users.create', compact('user', 'roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        $data['password'] = str_random(8);
        $user = User::create($data);
        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }        
        // Disparamos el evento de envio de credenciales.
        UserWasCreated::dispatch($user, $data['password']);
        return redirect()->route('admin.users.index')->with('exito', 'El usuario ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $permissions = Permission::pluck('name', 'id');
        $roles = Role::with('permissions')->get();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user) {
        $user->update($request->validated());
        return back()->with('exito', 'Usuario actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
