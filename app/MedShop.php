<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyMedShopEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MedShop extends Authenticatable implements MustVerifyEmail
{
	//
  	use Notifiable;

  	protected $table = 'medshop';

  	protected $guard = 'medshop';

  	protected $fillable = ['name', 'email', 'password','add1', 'add2', 'add_lat', 'add_lng'];

  	protected $hidden = ['password', 'remember_token',];

  	public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMedShopEmail);
    }
}