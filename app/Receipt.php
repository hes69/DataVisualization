<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //

    protected $fillable = [
        'total', 'timestamp',
    ];


    public function itemreceipt()
    {
        return $this->hasMany('App\Itemreceipt');
    }

}
