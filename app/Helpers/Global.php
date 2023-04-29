<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Twilio\Rest\Client;
use App\Models\User;
use Carbon\Carbon;


/**
 * Check array data
 * 
 * */
function mydd($data,$flag=0){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if(empty($flag)){
        exit;
    }
}


/**
 * Check Key Exixts With No Empty
 * 
 * */
function checkKeyExists($key,$data=array()){
    if(!empty($key)&&!empty($data)){
        if (array_key_exists($key,$data) && !empty($data[$key])) {
            return $data[$key];
        }
    }
    return false;
}


/**
 * String To Array 
 * */
function stringToArrayConvert($data=""){
    if(!empty($data)){
        $getNewArr=explode("/",$data);
        return array_filter($getNewArr);
    }
    return array();
}

/**
 * Send Email
 * */
function sendMyEmail($toEmail="",$emailContent=array()){
    if(!empty($toEmail) && !empty($emailContent)){
        try {
            \Mail::to($toEmail)->send(new \App\Mail\MyEmail($emailContent));
            return true;
        } catch (Exception $e) {
            Log::debug("Email Error: ". $e->getMessage());
            return false;
        }
    }
    return false;
}

function multiArraySortByColumn(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key => $row) {
        if(is_object($row)){
            $row=(array)$row;
        }
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}


/**
 * Generate OTP
 * */
function generateOtp(){
    $randomNumber = random_int(100000, 999999);
    return $randomNumber;
}

function sendMySMS($toMobile="",$messageContent=array()){
    try {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($toMobile, [
            'from' => $twilio_number, 
            'body' => implode(',',$messageContent)]);
        return true;
    } catch (Exception $e) {
        Log::debug("SMS Error: ". $e->getMessage());
        return false;
    }
    return false;
}
