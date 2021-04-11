<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Purchase extends Model
{
    protected $fillable = [
        'classified_id', 'image', 'name', 'price'
    ];
    use Searchable;

    public function buyerProfiles(){
        return $this->morphedByMany('App\BuyerProfile', 'purchaseable');
    }

    public function sellerProfiles(){
        return $this->morphedByMany('App\SellerProfile', 'purchaseable');
    }

    public function purchaseMessages(){
        return $this->hasMany(PurchaseMessage::class);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $classified = Classified::findOrFail($this->classified_id);
        $array['name'] = $classified->name;
        $array['price'] = $classified->price;
        $array['usage'] = $classified->usage;
        if ($this->buyerProfiles->first() != null){
            $array['buyer_id'] = $this->buyerProfiles->first()->user_id;
            $array['seller_id'] = $this->sellerProfiles->first()->user_id;
        }
        $array = $this->transform($array);
        return $array;
    }

    public function setBuyerFlag($rating)
    {
        $sellerProfile = $this->sellerProfiles->first();

        if ($this->seller_rated == true) {
            $this->active = false;
            $sellerProfile->addSale();
            $this->buyerProfiles->first()->addPurchase();
        }
        $sellerProfile->addReputation($rating);
        $this->save();
        return $this->buyer_rated = true;
    }

    public function setSellerFlag($rating)
    {
        $buyerProfile = $this->buyerProfiles->first();
        if ($this->buyer_rated == true) {
            $this->active = false;
            $this->sellerProfiles->first()->addSale();
            $buyerProfile->addPurchase();
        }
        $buyerProfile->addReputation($rating);
        if($rating == 'Positive'){
            $this->sellerProfiles->first()->user->addDebt($this->price);
        }
        $this->save();
        return $this->seller_rated = true;
    }
}
