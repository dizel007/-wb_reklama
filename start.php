<?php

require_once "func.php";
require_once "tokens/topen.php";
require_once "functions.php";
require_once "show_fullstat_about_campany.php";

// if (isset($_GET["start_date"])) {
// 	$start_date =$_GET["start_date"];
// } else {
// 	$start_date ='';
// }
// if (isset($_GET["finish_date"])) {
// 	$finish_date =$_GET["finish_date"];
// } else {
// 	$finish_date ='';
// }

// if (isset($_GET["active_company"])) {
// 	$active_company =$_GET["active_company"];
// } else {
// 	$active_company =0;
// }


// echo "Даты нчала и окончания кампании<br>";
// echo <<<HTML
//  <form action="#" method="get">
//  <input required type="date" name="start_date" value="$start_date"> Начало периода <Br><Br>
//  <input required type="date" name="finish_date" value="$finish_date"> Конец периода <Br>
//  <input type="checkbox" name="active_company" checked value="9"> Получить только активыные кампании <Br>

//  <p><input type="submit" value="Отправить">
// </form>
// HTML;



// die();

/*
Статус кампании:
-1 - кампания в процессе удаления new
4 - готова к запуску
7 - кампания завершена
8 - отказался
9 - идут показы
11 - кампания на паузе

Тип кампании:

4 - кампания в каталоге
5 - кампания в карточке товара
6 - кампания в поиске
7 - кампания в рекомендациях на главной странице
8 - автоматическая кампания
9 - поиск + каталог

*/
// $spisok_companies = get_all_campanies($token_reklama ,0); // второй парамет - статус компании Если поставить 0 - то выведет вернет все статусы

echo "<pre>";
// print_r($spisok_companies);

// foreach ($spisok_companies as $id_campany) {
// 	$info_about_campany[] = get_info_about_advert_campany($token_reklama, $id_campany['advertId'] ) ;
// }




$link_wb ="https://advert-api.wb.ru/adv/v2/fullstats";
echo "<pre>";
$data = array((array("id" => 12491527,
		             "interval" => array(
					  		"begin" => "2023-12-01",
						  	  "end" => "2023-12-31")
					)));

$data_send = json_encode($data, JSON_UNESCAPED_UNICODE);
// $info_about_campany = light_query_with_data____($token_reklama, $link_wb, $data_send);


// file_put_contents('xxx1.json', json_encode($info_about_campany, JSON_UNESCAPED_UNICODE));




$info_about_campany = json_decode(file_get_contents('xxx.json'), true);

echo "<pre>";
// print_r($info_about_campany[0]);




echo "<br>КОМПАНИИ ГДЕ ИДУТ ПОКАЗЫ<br>";
print_fullstat_about_campany($info_about_campany[0]);

die();
 

sleep(1);
unset($info_about_campany);
$res = get_all_campanies($token_reklama ,11); // второй парамет - статус компании Если поставить 0 - то выведет вернет все статусы
foreach ($res as $id_campany) {
	$info_about_campany[] = get_info_about_advert_campany($token_reklama, $id_campany['advertId'] ) ;
}

echo "<br>ПРИОСТАНОВЛЕННЫЕ КОМПАНИИ<br>";
print_fullstat_about_campany($info_about_campany);



function light_query_with_data____($token_wb, $link_wb, $data){
	$ch = curl_init($link_wb);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization:' . $token_wb,
		'Content-Type:application/json'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	
	$res = curl_exec($ch);
	
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
	curl_close($ch);
		echo     '<br>Результат обмена(SELECT with Data): '.$http_code. "<br>";

	$res = json_decode($res, true);
	// var_dump($res); // выводит результирующий массив
	return $res;

}
