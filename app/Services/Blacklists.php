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
        preg_match('/([ps]\d+,?\s?)+/', $line, $matches);
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
            throw new Exception("Advertiser does not exists.Requested id:" . $advertiserId);
        }
        if (!self::validateLine($blacklistLine)) {
            throw new Exception("Invalid input line format. Input line must be like \"p1, s11\",60");
        }
        $temp = explode(", ", $blacklistLine);
        foreach ($temp as $item) {
            $id = (int)substr($item, 1);
            if ($item[0] == "s") {
                Sites::save($id, $advertiser);
            }
            if ($item[0] == "p") {
                Publishers::save($id, $advertiser);
            }
        }
        return "Success";
    }

    public static function get($advertiserId)
    {
        $result = Sites::get($advertiserId);
        $result .= Publishers::get($advertiserId);
        return substr($result, 0, -2);
    }

}
