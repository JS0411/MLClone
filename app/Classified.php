<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Classified extends Model
{
    protected $guarded = [];
    use Searchable;

    protected $casts = [
        'images' => 'array'
    ];

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function favorited(){
        return $this->belongsToMany(User::class);
    }

    public function questionsCount() //Returns the number of unanswered questions
    {
        if ($this->question_count > 0) {
            return ($this->questions()->where('seller_reply', '')->pluck('id'));
        } else {
            return null;
        }
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['location'] = $this->sellerProfile->user->address;
        $array = $this->transform($array);
        return $array;
    }

    //Changes the status of the classified from active -> paused and vice-versa.

    public function flipActive()
    {
        $this->active = !($this->active);
        return $this->save();
    }
}
