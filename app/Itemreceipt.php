<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemreceipt extends Model
{
    //

    protected $fillable = [
        'quantity', 'totalprice','timestamp'
    ];

    public function receipt()
    {
        return $this->belongsTo('App\Receipt');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
