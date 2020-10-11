<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ladrillo extends Model
{
    protected $fillable = ['type','price','stock','status'];
}
