<?

require_once('xajax/xajax.inc.php');


$xajax = new xajax();


function calc_sum($count_sklad,$count_user,$count_items,$count_items_market,$count_on_off_market){
    $objResponse = new xajaxResponse();
    $objResponse->setCharEncoding('utf8');


	$GLOBALS['oauth_token']='8C0000013B80B90F';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Пример использования калькулятора
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

			$mass['count_sklad']=$count_sklad;							//Склады
			$mass['count_user']=$count_user;							//Пользователи
			$mass['count_items']=$count_items;							//Карточеки в программе

			$mass['count_items_market']=$count_items_market;			//Количество карточек синхронизируемых с Маркетплейсами
			$mass['count_on_off_market']=$count_on_off_market;			//Количество подключенных маркетов
			
			
			
			$data_json=json_encode($mass, JSON_UNESCAPED_UNICODE);
			
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'oauth_token: '.$GLOBALS['oauth_token'];
			
			
			$url = 'https://talant.it/api/index.php';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
			
			$result = curl_exec($ch);
			
			curl_close($ch);
			
			unset($data_json,$headers,$url,$ch);
			unset($mass);
			
			$result;	//result
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	$objResponse -> addAssign('result_span' , 'innerHTML' , $result);
	
	unset($result);
	
	return $objResponse;
}



$xajax->registerFunction("calc_sum");
$xajax->processRequests();
	

?>