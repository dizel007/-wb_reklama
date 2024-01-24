<?php

require_once "func.php";
require_once "tokens/topen.php";
require_once "functions.php";
require_once "show_fullstat_about_campany.php";
require_once "show_all_campany.php";
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
$spisok_companies = get_all_campanies($token_wb ,0); // второй парамет - статус компании Если поставить 0 - то выведет вернет все статусы


// получаем списки компаний в работе и в ожидании (мертвые компании выкидываем)
foreach ($spisok_companies as $key => $campany) {
	if (($key == 9) OR ($key == 11)) {
		foreach ($campany as $item) {
			$arr_campany[] = $item;
			$arr_id_campany[] = $item['advertId'];
		}
	}
	
}
// $arr_id_campany = array(12492619);

$link_wb = 'https://advert-api.wb.ru/adv/v1/promotion/adverts?order=create';
// Получаем компании с полной информацией
$info_about_campany = light_query_with_data($token_wb, $link_wb, $arr_id_campany);


// echo "<pre>";
// print_r($info_about_campany);

print_all_campany($info_about_campany);
die();

$link_wb = "https://advert-api.wb.ru/adv/v2/fullstats";
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


