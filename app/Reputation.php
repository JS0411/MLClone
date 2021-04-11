<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reputation extends Model
{
    protected $fillable = ['user_id','rating', 'description', 'classified_name',
        'classified_id', 'rater_name', 'rater_id', 'image'];

    public function reputationable(){
        return $this->morphTo();
    }
}
