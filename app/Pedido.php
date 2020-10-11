<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'codigo',
        'user_id',
        'ladrillo_id',
        'customer_id',
        'horno_id',
        'delivery_type'
        ,'delivery_date'
        ,'quantity',
        'status'];


    public function ladrillo()
    {
        return $this->belongsTo(Ladrillo::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function horno()
    {
        return $this->belongsTo(Horno::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
