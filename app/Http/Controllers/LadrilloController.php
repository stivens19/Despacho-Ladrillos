<?php

namespace App\Http\Controllers;

use App\Ladrillo;
use Illuminate\Http\Request;

class LadrilloController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    
    public function index()
    {
        $ladrillos=Ladrillo::all();
        return view('ladrillos.index',compact('ladrillos'));
    }

    public function store(Request $request)
    {
        $data=request()->validate([
            'type'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
        ]);

        Ladrillo::create([
            'type' => $data['type'],
            'price'=>$data['price'],
            'stock'=>$data['stock'],
            'status'=>$request->status
        ]);
        return redirect()->back()->withSuccess('Se registro el nuevo tipo de ladrillo');
    }


    public function edit(Ladrillo $ladrillo)
    {
  
        return view('ladrillos.edit',compact('ladrillo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ladrillo  $ladrillo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ladrillo $ladrillo)
    {
        $data=request()->validate([
            'type'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
        ]);

        $ladrillo->update([
            'name' => $data['type'],
            'price'=>$data['price'],
            'stock'=>$data['stock'],
        ]);

        return redirect()->route('ladrillos.index')->withSuccess('Se actualizo !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ladrillo  $ladrillo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ladrillo $ladrillo)
    {
        if ($ladrillo->status == 'inactivo') {
            $ladrillo->update([
                'status'=>'activo',
            ]);
        } else {
            $ladrillo->update([
                'status'=>'inactivo',
            ]);
        }

        return redirect()->route('ladrillos.index')->withSuccess('Se cambio el estado correctamente');
    }
}
