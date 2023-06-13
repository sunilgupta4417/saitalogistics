<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Twilio\Rest\Client;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\ShippingZone;
use Crypt;

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
 * get Countries
 * 
 * */
function getCountriesByIds($countryIds=array()){
    return ShippingZone::select("id","country")->whereIn('id',$countryIds)->get()->toArray();
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

function getBookingStatus($key=""){

    $bookingStatus=array(0=>"Waiting For Quotation",1=>"Quote Acceptance",2=>"Waiting For Space",3=>"Pay Now",4=>"Completed");
    if(isset($key)){
        return $bookingStatus[$key];
    }
    return $bookingStatus;
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

/**
 * Generate Random Numbers
 * */
function generateRandomString(){
    // Available alpha caracters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // generate a pin based on 2 * 7 digits + a random character
    $pin = mt_rand(1000000, 9999999) . mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];
    // shuffle the result
    $string = str_shuffle($pin);
    return $string;
}
function getLogisRefImagePath($imageName=""){
    if(!empty($imageName)){
        return "logistics/reference_files/".$imageName;
    }else{
        return "logistics/reference_files/";
    }
}
function getCourierTypes(){
    $shipments=array("air","ocean","courier");
    return $shipments;
}
function getAlphabates($key="",$limit=25){
    $alphabates=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $counter=0;
    $startAlpha=0;
    for($i=26; $i<=$limit;$i++){
        $alphabates[]=$alphabates[$startAlpha].$alphabates[$counter];
        $counter++;
        if($counter==26){
            $counter=0;
        }
        if($i==51){
            $startAlpha=1;
        }elseif($counter==77){
            $startAlpha=2;
        }
    }
    if(isset($key)){
        return $alphabates[$key];
    }
    return $alphabates;
}

function encryptToBase64($key=""){
    if(!empty($key)){
        return "WA".base64_encode(base64_encode($key));
    }
}
function decryptFromBase64($key=""){
    if(!empty($key)){
        $key=substr($key,2);
        return base64_decode(base64_decode($key));
    }
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
