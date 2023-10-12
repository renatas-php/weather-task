<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

use Adrianorosa\GeoLocation\GeoLocation;

class GeoLocationHelper {

    public static function getUserCity()
    {
        $details = GeoLocation::lookup(Request()->ip());
        if($details)
        {
            return $details->getCity();
        }
        return null;
    }

}
