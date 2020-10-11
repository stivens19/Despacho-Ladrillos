<?php

namespace App\Http\Controllers;

use App\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set("America/Lima");
        $date=Carbon::now()->format('Y-m-d');
        $pedidos=auth()->user()->pedidos()->where('delivery_date','>=',$date)->where('status','pendiente')->take(8)->orderBy('delivery_date')->get();

        return view('home',compact('pedidos','date'));
    }
}
