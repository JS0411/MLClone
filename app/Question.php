<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['buyer_message', 'seller_reply'];

    protected $dates = ['created_at', 'updated_at'];

    public function classified()
    {
        return $this->belongsTo(Classified::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUpdatedAtAttribute() {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
}
