<?


$GLOBALS['oauth_token']='8C0000013B80B90F';


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Получаем массив, для формирования таблиц в разделе Тарифы
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

			$mass['config']='config';
			
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
			
			$result_config = curl_exec($ch);
			
			curl_close($ch);
			
			unset($data_json,$headers,$url,$ch);			
			unset($mass);
			
			$result_config;	//result
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Пример использования калькулятора
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

			$mass['count_sklad']=1;				//Склады
			$mass['count_user']=1;				//Пользователи
			$mass['count_items']=101;			//Карточеки в программе
			
			$mass['count_items_market']=100;	//Количество карточек синхронизируемых с Маркетплейсами
			$mass['count_on_off_market']=3;		//Количество подключенных маркетов
			
			
			
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
	
	
	
	echo $result_config;
	// echo $result;




	
	unset($result_config,$result);
	

?>