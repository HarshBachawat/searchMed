<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";
    protected $fillable = ['client_name', 'mob_no', 'medicine', 'quantity', 'price', 'invoice_id', 'med_id'];

    public function medshop(){

        return $this->belongsTo('App\MedShop','med_id');
    }
}
