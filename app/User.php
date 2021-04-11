<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'name', 'surname', 'state', 'address', 'id_number',
        'birthdate', 'email', 'password', 'debt',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
        parent::boot();

        static::created(function ($user){
            $user->sellerProfile()->create();
            $user->buyerProfile()->create();
        });
    }

    public function classifieds()
    {
        return $this->hasManyThrough('App\Classified', 'App\SellerProfile');
    }

    public function buyerProfile()
    {
       return $this->hasOne(BuyerProfile::class);
    }

    public function sellerProfile()
    {
       return $this->hasOne(SellerProfile::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Classified::class);
    }

    public function addDebt($price)
    {
        $this->debt = $this->debt + ($price * 0.05);
        $this->save();
        return true;
    }

}
