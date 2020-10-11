<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Horno;
use App\Ladrillo;
use App\Pedido;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin'])->except(['cambio']);
    }
    
    public function index()
    {
        $pedidos=Pedido::orderBy('delivery_date', 'ASC')->get();
        $ladrillos=Ladrillo::where('status', 'activo')->get();
        $customers=Customer::where('status', 'activo')->get();
        $hornos=Horno::where('status', 'activo')->get();
        $choferes=User::where('role_id', 2)->get();
        date_default_timezone_set("America/Lima");
        $date=Carbon::now()->format('Y-m-d');
        return view('pedidos.index',compact('pedidos','ladrillos','customers','hornos','choferes','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelados()
    {
        $pedidos=Pedido::where('status', 'cancelado')->get();
        return view('pedidos.cancelados',compact('pedidos'));
    }

    public function store(Request $request)
    {
        
        $data=request()->validate([
            'codigo'=>'required',
            'delivery_date'=>'required|date',
            'quantity'=>'required|numeric',
            'ladrillo_id'=>'required',
            'delivery_type'=>'required',
            'customer_id'=>'required',
            'horno_id'=>'required',
            'user_id'=>'required',
        ]); 
  
        $ladrillo=Ladrillo::findOrfail(request('ladrillo_id'));
                
        $stock=$ladrillo->stock;
        $cantidad=request('quantity');
        $stock_final=$stock-$cantidad;
        if ((($ladrillo->stock > $cantidad) && ($ladrillo->stock > 0)) ) {
            DB::table('pedidos')->insert([
                'codigo'=>$data['codigo'],
                'delivery_date'=>$data['delivery_date'],
                'quantity'=>$data['quantity'],
                'ladrillo_id'=>$data['ladrillo_id'],
                'delivery_type'=>$data['delivery_type'],
                'customer_id'=>$data['customer_id'],
                'horno_id'=>$data['horno_id'],
                'user_id'=>$data['user_id'],
                'status'=>'pendiente',
            ]);
            
      
    
            $ladrillo->update([
                'stock'=>$stock_final,
            ]);
    
            return redirect()->back()->withSuccess('Se registro el pedido');
        }else{
            return redirect()->back()->with('error','Error no tiene la cantidad para abastecer este pedido');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->update([
            'status'=>'cancelado',
        ]);
        $cantidad=$pedido->quantity;
        $ladrillo=Ladrillo::findOrfail($pedido->ladrillo_id);
        $stock=$ladrillo->stock;
        $stock_final=$cantidad+$stock;
        $ladrillo->update([
            'stock'=>$stock_final,
        ]);

        return redirect()->back()->withSuccess('Se cancelo el pedido , se retorno la cantidad al stock');
    }
    public function cambio($id)
    {
        $pedido=Pedido::findOrfail($id);
        if($pedido->status == 'pendiente'){
            $pedido->update([
                'status'=>'entregado',
            ]);
        }else{
            $pedido->update([
                'status'=>'pendiente',
            ]);
        }
        return redirect()->back()->withSuccess('El estado fue cambiado');
    }
}
