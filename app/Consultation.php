<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function comments()
    {
        return $this->hasMany('App\ConsultationComment');
    }
    
}
