<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    public function index()
    {
        $roles=Role::all();
        return view('roles.index',compact('roles'));
    }
    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'string',
        ]);
        Role::create([
            'name' => $data['name'],
            'display_name'=>$data['display_name'],
            'description'=>$data['description']
        ]);
        return redirect()->route('roles.index')->withSuccess('El rol fue creado satisfactoriamente');
    }

    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data=request()->validate([
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'string'
        ]);

        $role->update([
            'name'=>$data['name'],
            'display_name'=>$data['display_name'],
            'description'=>$data['description']
        ]);


        return redirect()->route('roles.index')->withSuccess('Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
}
