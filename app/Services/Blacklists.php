<?php

namespace App\Services;

use App\Http\Resources\BlacklistResourse;
use App\Models\Advertiser;
use App\Models\Blacklist;
use App\Models\Publisher;
use App\Models\Site;
use Mockery\Exception;

class Blacklists
{

    private static function validateLine($line)
    {
        $prefixes=Publishers::PREFIX.Sites::PREFIX;
        preg_match("/([<$prefixes>]\d+,\s)*([<$prefixes>]\d+)/", $line, $matches);
        return $matches && $matches[0] == $line;
    }

    public static function findOrCreate($advertiser, $entity)
    {
        return $entity->blacklists()->firstOrNew(['advertiser_id' => $advertiser->id]);
    }

    public static function save($blacklistLine, $advertiserId)
    {
        $advertiser = Advertiser::find($advertiserId);
        $blacklistLine = trim($blacklistLine);
        if (!$advertiser) {
            return Errors::generateErrorNoAdvertiser($advertiserId);
        }
        if (!self::validateLine($blacklistLine)) {
            return Errors::generateErrorInvalidInput();
        }
        $temp = explode(", ", $blacklistLine);
        foreach ($temp as $item) {
            $id = (int)substr($item, 1);
            if ($item[0] == Sites::PREFIX) {
                if(!Sites::save($id, $advertiser)){
                    return Errors::generateErrorNoSite($id);
                };
            }
            if ($item[0] == Publishers::PREFIX) {
                if(!Publishers::save($id, $advertiser)){
                    return Errors::generateErrorNoPublisher($id);
                };
            }
        }
        return json_encode(['status'=>'Success']);
    }

    public static function get($advertiserId)
    {
        if(!Advertiser::find($advertiserId)){
            return Errors::generateErrorNoAdvertiser($advertiserId);
        }
        $result = Sites::get($advertiserId);
        $result .= Publishers::get($advertiserId);
        return json_encode(['status'=>'Success', 'message'=> substr($result, 0, -2)]) ;
    }

}
