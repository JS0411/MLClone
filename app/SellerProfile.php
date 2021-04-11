<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function classifieds(){
        return $this->hasMany(Classified::class);
    }

    public function sales(){
        return $this->morphToMany(Purchase::class, 'purchaseable');
    }

    public function reputations(){
        return $this->morphMany('App\Reputation', 'reputationable');
    }

    public function addSale(){
        $this->sales_count++;
        $this->save();
        return true;
    }

    public function addReputation($rating){
        if ($rating == 'Positive'){
            $this->positive_rep++;
        } else if ($rating == 'Neutral'){
            $this->neutral_rep++;
        } else {
            $this->negative_rep++;
        }
        $this->save();
        return true;
    }
}
