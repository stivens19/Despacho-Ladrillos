<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    public function index()
    {
        $roles=Role::all(['id','display_name']);
        $users=User::all();
        return view('users.index',compact('roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'string|required',
            'role_id'=>'integer',
            'dni'=>'string|size:8',
            'email'=>'email|required',
        ]);

        User::create([
            'role_id'=> $data['role_id'],
            'name' => $data['name'],
            'dni'=> $data['dni'],
            'email'=> $data['email'],
            'placa'=> request('placa'),
            'password'=>
            Hash::make($request->password),
            
        ]);

        return redirect()->route('users.index')->withSuccess('El usuario fue creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles=Role::all(['id','display_name']);
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data=request()->validate([
            'name'=>'string|required',
            'role_id'=>'integer',
            'dni'=>'string|size:8',
            'email'=>'email|required',
        ]);

        if ($request->password) {
            $user->update([
                'role_id'=> $data['role_id'],
                'name' => $data['name'],
                'dni'=> $data['dni'],
                'email'=> $data['email'],
                'placa'=> request('placa'),
                'password'=>
                Hash::make($request->password),
            ]);
        }else{
            $user->update([
                'role_id'=> $data['role_id'],
                'name' => $data['name'],
                'dni'=> $data['dni'],
                'email'=> $data['email'],
                'placa'=> request('placa'),
            ]);
        }
        return redirect()->route('users.index')->withSuccess('El usuario fue actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->withSuccess("El usuario {$user->name} fue eliminado" );
    }
}
