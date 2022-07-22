<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger {
    static protected $slugColumnName = 'slug';
     static public function getSlug($strOrigin) {
        $slugOrigin = Str::slug($strOrigin) . '';
        $slug = $slugOrigin;

        $i = 1;

//con self punta alla classe in cui viene richiamata
       while (self::where(self::$slugColumnName, $slug)->first()) {
        $slug = $slug . '-' . $i;
        $i++;
       }

       return $slug;
    }
}

