<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'address', 'phone', 'birth'
    ];


    //per dare il nome della tabella senza la convenzione del plurale
    protected $table = 'users_details';

    public function user(){
        //scelgo quale mi serve
        //return $this->hasOne(''); //nella tabella che non ha il foreign Key
        return $this->belongsTo('App\Models\User'); //nella tabella del foreign Key

    }
}
