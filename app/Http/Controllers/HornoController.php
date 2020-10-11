<?php

namespace App\Http\Controllers;

use App\Horno;
use Illuminate\Http\Request;

class HornoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    
    public function index()
    {
        $hornos=Horno::all();

        return view('hornos.index',compact('hornos'));
    }

    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required',
            'capacity'=>'required|numeric'
        ]);

        Horno::create([
            'name' => $data['name'],
            'capacity'=>$data['capacity'],
            'status'=>request('status')
        ]);

        return redirect()->back()->withSuccess('Horno creado');
    }

    

    public function edit(Horno $horno)
    {
        return view('hornos.edit',compact('horno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horno  $horno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horno $horno)
    {
        $data=request()->validate([
            'name'=>'required',
            'capacity'=>'required|numeric'
        ]);

        $horno->update([
            'name' => $data['name'],
            'capacity'=>$data['capacity'],
        ]);
        return redirect()->route('hornos.index')->withSuccess('Horno actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horno  $horno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horno $horno)
    {
        if ($horno->status == 'inactivo') {
            $horno->update([
                'status'=>'activo',
            ]);
        } else {
            $horno->update([
                'status'=>'inactivo',
            ]);
        }

        return redirect()->route('hornos.index')->withSuccess('Se cambio el estado correctamente');
    }
}
