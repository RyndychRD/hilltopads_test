<?php

namespace App\Services;

use App\Models\Advertiser;
use App\Models\Blacklist;
use App\Models\Publisher;
use Mockery\Exception;

class Publishers
{
    const PREFIX='p';
    public static function save($publisherId, $advertiser){
        $publisher = Publisher::find($publisherId);
        if(!$publisher){
            return false;
        }
        $blacklist=Blacklists::findOrCreate($advertiser,$publisher);
        $blacklist->publisher()->associate($publisher);
        $blacklist->save();
        return true;
    }

    public static function get($advertiserId){
        $result="";
        $blacklists = Advertiser::find($advertiserId)->blacklists()->has('publisher')->get();
        if(!$blacklists){
            return false;
        }
        foreach ($blacklists as $blacklist) {
            $result .= self::PREFIX . $blacklist->publisher->id . ", ";
        }
        return $result;
    }
}
