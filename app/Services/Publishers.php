<?php

namespace App\Services;

use App\Models\Advertiser;
use App\Models\Blacklist;
use App\Models\Publisher;
use Mockery\Exception;

class Publishers
{
    public static function save($publisherId, $advertiser){
        $publisher = Publisher::find($publisherId);
        if(!$publisher){
            throw new Exception("Publisher does not exist. Requested id:".$publisherId);
        }
        $blacklist=Blacklists::findOrCreate($advertiser,$publisher);
        $blacklist->publisher()->associate($publisher);
        $blacklist->save();
    }

    public static function get($advertiserId){
        $result="";
        $blacklists = Advertiser::find($advertiserId)->blacklists()->has('publisher')->get();
        foreach ($blacklists as $blacklist) {
            $result .= 'p' . $blacklist->publisher->id . ", ";
        }
        return $result;
    }
}
