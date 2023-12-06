<?php

require_once "func.php";
require_once "topen.php";
require_once "functions.php";


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
$res = get_all_campanies($token_reklama ,9); // второй парамет - статус компании Если поставить 0 - то выведет вернет все статусы
// echo "<br> ***********88888888888888888888888888888*********************<br>";

// echo "<pre>";
// print_r($res);

foreach ($res as $id_campany) {
	// echo "<br> ***********". $id_campany['advertId'] ."**********************<br>";
	$info_about_campany[] = get_info_about_advert_campany($token_reklama, $id_campany['advertId'] ) ;
	// $res1 = get_statistic_poisk_advert_campany($token_reklama, $id_campany['advertId']); //Статистика по компаниям "ПОИСК"
	// $res1[]  = get_statistic_automat_advert_campany($token_reklama, $id_campany['advertId']); // Статистика по "автоматическим" компаниям
	// $res1[]  = get_full_statistic_advert_campany($token_reklama, 7414331); // полная статистика по компаниям
	
	sleep(1);
	// print_r($rev);
	// echo "<br> *************0000000000000000000000000000000000000000000000000*************************************************";
}

// print_r($info_about_campany);




echo "<link rel=\"stylesheet\" href=\"styles.css\">";
echo "<table>";

echo "<tr>";

	echo "<td class=\"stroka\"><b>Название компании</b></td>";
	echo "<td class=\"stroka\"><b>Фин. информация<br> по компании</b></td>";
	echo "<td class=\"stroka\"><b>Подробная информация<br> по компании</b></td>";
	echo "<td class=\"stroka\"><b>Статус</b></td>";
	echo "<td class=\"stroka\"><b>тип компании</b></td>";

echo "</tr>";


foreach ($info_about_campany as $campany) {
	$id_company = $campany['advertId'];
	echo "<tr>";
		echo "<td class=\"stroka\">".$campany['name']."</td>";
		echo "<td class=\"stroka\"><a href=\"full_stat.php?id_campany=$id_company\" target=\"_blank\">".$id_company ."</a></td>";
	// для компании ПОИСК 
	if ($campany['type'] == 6) {
		echo "<td class=\"stroka\"><a href=\"campany_poisk.php?id_campany=$id_company\" target=\"_blank\">".$id_company ."</a></td>";
	} else {
		echo "<td class=\"stroka\">".$campany['type']."</td>";
	}
		echo "<td class=\"stroka\">".$campany['status']."</td>";
		echo "<td class=\"stroka\">".print_campany_type($campany['type'])."</td>";

	echo "</tr>";

}


echo "<table>";

die();

// $res1[]  = get_full_statistic_advert_campany($token_reklama, 7414331); // полная статистика по компаниям

// //статистика по ключенвым фразам в этой компании 
// print_r($res1[0]);

// $kkk = json_decode(file_get_contents("xxx.json") , true);
// print_r($kkk);


function print_campany_type($type){
	if ($type == 4)  {
		return "кампания в каталоге";
	} elseif ($type == 5)  {
		return "кампания в карточке товара";
	} elseif ($type == 6)  {
		return "кампания в поиске";
	} elseif ($type == 7)  {
		return "кампания в рекомендациях на главной странице";
	} elseif ($type == 8)  {
		return "автоматическая кампания";
	} elseif ($type == 9)  {
		return "поиск + каталог";
	} else {
		return "!!! НЕТ ДАННЫХ";
	}


}

