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
            return json_encode(['status'=>'error', 'error_type'=>1, 'error_message'=>'Advertiser does not exists.Requested id:' . $advertiserId]);
        }
        if (!self::validateLine($blacklistLine)) {
            return json_encode(['status'=>'error', 'error_type'=>2,'error-message'=>"Invalid input line format."]);
        }
        $temp = explode(", ", $blacklistLine);
        foreach ($temp as $item) {
            $id = (int)substr($item, 1);
            if ($item[0] == Sites::PREFIX) {
                if(!Sites::save($id, $advertiser)){
                    return json_encode(['status'=>'error', 'error_type'=>3,'error-message'=>"Site does not exist. Requested id:".$id]);
                };
            }
            if ($item[0] == Publishers::PREFIX) {
                if(!Publishers::save($id, $advertiser)){
                    return json_encode(['status'=>'error', 'error_type'=>3,'error-message'=>"Publisher does not exist. Requested id:".$id]);
                };
            }
        }
        return json_encode(['status'=>'Success']);
    }

    public static function get($advertiserId)
    {
        if(!Advertiser::find($advertiserId)){
            return json_encode(['status'=>'error', 'error_type'=>1, 'error_message'=>'Advertiser does not exists.Requested id:' . $advertiserId]);
        }
        $result = Sites::get($advertiserId);
        $result .= Publishers::get($advertiserId);
        return json_encode(['status'=>'Success', 'message'=> substr($result, 0, -2)]) ;
    }

}
