<?php
/**
* Success Response Send
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('sendResponse')){
	function sendResponse($message,$data=null)
	{
		if($data)
			return response()->json(['status'=>true,'message'=>$message,'data'=>$data]);
		return response()->json(['status'=>true,'message'=>$message]);
	}
}
/**
* Error Response Send
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('sendErrorResponse')){
	function sendErrorResponse($message,$data=null)
	{
		if($data)
			return response()->json(['status'=>false,'message'=>$message,'data'=>$data]);
		return response()->json(['status'=>false,'message'=>$message]);
	}
}
/**
* Call Third party API's
*
* @version 1.0.0
* @since 1.0
*/
if(!function_exists('callAPI')){
	function callAPI($method, $url, $header=null, $data=null)
	{
		$api_url = config('setting.api_url').config('setting.api_prefix');
	   	$header_data = array(
	      	'Accept: application/json',
	      	'Content-Type: application/json',
	   	);
        if(!empty(\Session::has('access_token')))
	   		$header_data[] = 'Authorization: Bearer ' . \Session::get('access_token');
	   	if(is_array($header) && count($header)){
	   		$header_data = array_merge($header_data,$header);
	   	}
	   	$curl = curl_init();
	   	switch (strtolower($method)){
	      	case "post":
				        curl_setopt($curl, CURLOPT_POST, 1);
				        if ($data)
				            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
				        break;
	      	case "put":
	         			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				        if ($data)
				            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                
				        break;
	      	default:
	         			if ($data)
	            			$url = sprintf("%s?%s", $url, http_build_query($data, '', '&'));
	   	}
	   	curl_setopt($curl, CURLOPT_URL,$api_url .$url);
	   	curl_setopt($curl, CURLOPT_HTTPHEADER, $header_data);
	   	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	   	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 50);          //Timeout after 50 seconds
	   	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	   	// EXECUTE:
	   	$result = curl_exec($curl);
	   	$err = curl_error($curl);
	   	curl_close($curl);
	   	return $result ? json_decode($result, true) : ( $err ? json_decode($err, true) : null);
	}
}
if(!function_exists('callAPIImageUpload')){
	function callAPIImageUpload($method, $url, $header=null, $images=[], $data=null)
	{
		$api_url = config('setting.api_url').config('setting.api_prefix');
	   	$header_data = array(
	      	'Accept: application/json',
	      	'Content-Type: multipart/form-data',
	   	);
        if(!empty(\Session::has('access_token')))
	   		$header_data[] = 'Authorization: Bearer ' . \Session::get('access_token');
	   	if(is_array($header) && count($header)){
	   		$header_data = array_merge($header_data,$header);
	   	}
	   	$curl = curl_init();
	   	foreach ($images as $key => $value) {
	   		$cfile[$key] = new CURLFILE($value['tmp_name'],$value['type'],$value['name']);
	   	}
	   	if(count($data)){
			foreach ($data as $key => $value) {
				$cfile[$key] = $value;
			}
	   	}
	   	curl_setopt($curl, CURLOPT_URL,$api_url .$url);
	   	curl_setopt($curl, CURLOPT_HTTPHEADER, $header_data);
		curl_setopt($curl, CURLOPT_POST, 1);
	   	curl_setopt($curl, CURLOPT_POSTFIELDS, $cfile);
	   	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	   	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 50);          //Timeout after 50 seconds
	   	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	   	// EXECUTE:
	   	$result = curl_exec($curl);
	   	$err = curl_error($curl);
	   	curl_close($curl);
	   	return $result ? json_decode($result, true) : ( $err ? json_decode($err, true) : null);
	}	
}
/**
* Get Version
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('getVersion')){
	function getVersion()
	{
		$response = callAPI('get','getSSVVersion');
		return $response['status']===true ? $response['versionData'] : die(__('message.general_error'));
	}
}

/**
* Explode image string and return image list
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('imageList')){
	function imageList($images,$slug=','){
		$finalList = [];
		if(!empty($images)){
			$imageList = explode($slug, $images);
			foreach ($imageList as $key => $value) {
				$finalList[] = config('setting.api_url') . $value;				
			}
		}
		$total = count($finalList);
		return $total > 0 ? ($total > 1 ? $finalList : $finalList[0]) : [];
	}
}


/**
* Check if logged or not and get User Details
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('isLogged')){
	function isLogged(){
        if(Session::has('access_token')) return true;
        return false;
	}
}

/**
* Get Service charges and limit of transactions
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('getServicesCharges')){
	function getServicesCharges($Tax_id=null){
		if(!isLogged()) return [];
		$response = callAPI('get','getServicesCharges');
		$finalList = [];
		if($response['status']){
			if($Tax_id){
				if(count($response['tax'])){
					foreach ($response['tax'] as $key => $value) {
						if($value['Tax_id']==$Tax_id){
							$finalList[] = $value;
							return $finalList;
						}
					}
				}
			} else {
				$finalList = $response['tax'];
			}
		}
		return $finalList;
	}
}

/**
* Get All common list used in project
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('ssvAllList')){
	function ssvAllList($type=null){
		if(!isLogged()) return [];		
		$response = callAPI('get','ssvAllList');
		$finalList = [];
		if($response['status']){
			if($type){
				if(count($response['data'])){
					foreach ($response['data'] as $key => $value) {
						if($key==$type){
							$finalList[$key] = $value;
							return $finalList;
						}
					}
				}
			} else {
				$finalList = $response['data'];
			}
		}
		return $finalList;
	}
}

/**
* Get Menu list in project
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('ssvMenuList')){
	function ssvMenuList($type=null){
		$finalList = [];
		if(!isLogged()) return [];
		$response = callAPI('get','ssvMenuList');
		if($response['status']){
			if($type){
				if(count($response['data'])){
					foreach ($response['data'] as $key => $value) {
						if($key==$type){
							$finalList[$key] = $value;
							return $finalList;
						}
					}
				}
			} else {
				$finalList = $response['data'];
			}
		}
		return $finalList;
	}
}

/**
* Get Menu list in project
*
* @version 1.0.0
* @since 1.0
*/

if(!function_exists('ssvEventList')){
	function ssvEventList(){
		if(!isLogged()) return [];
		$response = callAPI('get','ssvEventList');
		return $response['status']===true ? $response['data'] : die(__('message.general_error'));
	}
}

?>