<?php

namespace App\Services;

class Errors
{
    public static function generateErrorNoAdvertiser($error_id){
        return json_encode(['status'=>'error', 'error_type'=>1, 'error_message'=>'Advertiser does not exists.Requested id:' . $error_id]);
    }
    public static function generateErrorInvalidInput(){
        return json_encode(['status'=>'error', 'error_type'=>2,'error-message'=>"Invalid input line format."]);
    }
    public static function generateErrorNoSite($error_id){
        return json_encode(['status'=>'error', 'error_type'=>3,'error-message'=>"Site does not exist. Requested id:".$error_id]);
    }
    public static function generateErrorNoPublisher($error_id){
        return json_encode(['status'=>'error', 'error_type'=>3,'error-message'=>"Publisher does not exist. Requested id:".$error_id]);
    }
}
