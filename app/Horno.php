<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horno extends Model
{
    protected $fillable = ['name','capacity','status'];
}
