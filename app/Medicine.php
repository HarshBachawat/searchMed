<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = "medicine";
    protected $fillable = ['name', 'quantity', 'price','med_id'];

    public function medshop(){

        return $this->belongsTo('App\MedShop','med_id');
    }
}
