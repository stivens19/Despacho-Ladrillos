<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    public function index()
    {
        $clientes=Customer::all();
        return view('customers.index',compact('clientes'));
    }


    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required',
            'adress'=>'required',
            'phone'=>'required|size:9',
        ]);

        Customer::create([
            'name' => $data['name'],
            'adress'=>$data['adress'],
            'phone'=>$data['phone'],
            'status'=>request('status'),
        ]);

        return redirect()->back()->withSuccess('El cliente fue creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data=request()->validate([
            'name'=>'required',
            'adress'=>'required',
            'phone'=>'required|size:9',
        ]);

        $customer->update([
            'name' => $data['name'],
            'adress'=>$data['adress'],
            'phone'=>$data['phone'],
        ]);

        return redirect()->route('customers.index')->withSuccess('El cliente fue actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {

        if ($customer->status == 'inactivo') {
            $customer->update([
                'status'=>'activo',
            ]);
        } else {
            $customer->update([
                'status'=>'inactivo',
            ]);
        }

        return redirect()->route('customers.index')->withSuccess('Se cambio el estado correctamente');
    }
}
