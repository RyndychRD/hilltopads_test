<?php

namespace App\Services;

use App\Models\Advertiser;
use App\Models\Blacklist;
use App\Models\Site;
use Mockery\Exception;

class Sites
{
    const PREFIX="s";

    public static function save($siteId, $advertiser)
    {
        $site = Site::find($siteId);
        if(!$site){
            return false;
        }
        $blacklist=Blacklists::findOrCreate($advertiser,$site);
        $blacklist->site()->associate($site);
        $blacklist->save();
        return true;

    }

    public static function get($advertiserId){
        $result="";
        $blacklists = Advertiser::find($advertiserId)->blacklists()->has('site')->get();
        foreach ($blacklists as $blacklist) {
            $result .= self::PREFIX . $blacklist->site->id . ", ";
        }
        return $result;
    }

}
