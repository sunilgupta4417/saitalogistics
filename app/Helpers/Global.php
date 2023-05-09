<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Twilio\Rest\Client;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\ShippingZone;


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
 * get Country
 * 
 * */
function getCountriesWithCode(){
    return ShippingZone::select("id","country")->get()->toArray();
}
/**
 * get Countries
 * 
 * */
function getCountries($key=""){
    $countries=getCountriesWithCode();
    $countryIds=array_column($countries,"id");
    $countryNames=array_column($countries,"country");
    $countriesInfo=array_combine($countryIds,$countryNames);
    if(!empty($key)){
        return checkKeyExists($key,$countriesInfo);
    }
    return $countriesInfo;
}

/**
 * get Country form country table
 * 
 * */
function getCountriesDetails(){
    return Country::select("id","country_name","mobile_code","country_code")->orderBy("country_code","ASC")->get()->toArray();
}
function getCountryBMDCodes(){
    $countries=getCountriesDetails();
    //mydd($countries);
    return $countries;
}
function getCountryBMCodes($key=""){
    $countries=getCountriesDetails();
    $countryIds=array_column($countries,"id");
    $mobile_code=array_column($countries,"mobile_code");
    $countriesInfo=array_combine($countryIds,$mobile_code);
    if(!empty($key)){
        return checkKeyExists($key,$countriesInfo);
    }
    return $countriesInfo;
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
 * Json To Array 
 * */
function jsonToArrayConvert($data=""){
    if(!empty($data)){
        return json_decode($data,true);
    }
    return array();
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
