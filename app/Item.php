<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

    protected $fillable = [
        'name', 'unitprice',
    ];



    public function categories()
    {
        return $this->hasMany('App\Category');
    }
    public function Itemreceipt()
    {
        return $this->hasone('App\Itemreceipt');
    }


}
