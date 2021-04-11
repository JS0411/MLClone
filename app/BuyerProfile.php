<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerProfile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function purchases(){
        return $this->morphToMany(Purchase::class, 'purchaseable');
    }

    public function reputations(){
        return $this->morphMany('App\Reputation', 'reputationable');
    }

    public function addPurchase(){
        $this->purchases_count++;
        $this->save();
        return true;
    }

    public function addReputation($rating){
        if ($rating == 'Positive'){
            $this->positive_rep++;
            $this->user->addDebt($this->price);
        } else if ($rating == 'Neutral'){
            $this->neutral_rep++;
        } else {
            $this->negative_rep++;
        }
        $this->save();
        return true;
    }
}
