<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','display_name','description'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
