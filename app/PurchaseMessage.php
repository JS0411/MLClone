<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PurchaseMessage extends Model
{
    protected $fillable = ['message', 'sender'];

    protected $dates = ['created_at'];

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    public function getCreatedAtAttribute() {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
