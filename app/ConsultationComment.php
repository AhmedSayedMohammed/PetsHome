<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationComment extends Model
{
    protected $table = 'consultationcomments';
    public function consultations()
    {
        return $this->belongsTo('App\Consultation');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
