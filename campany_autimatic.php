<?php
require_once "func.php";
require_once "tokens/topen.php";
require_once "functions.php";
echo "<link rel=\"stylesheet\" href=\"styles.css\">";


$id_campany = $_GET['id_campany'];
// $mini_info = get_MINI_statistic_automat_advert_campany($token_reklama, $id_campany);

echo "<pre>";

// print_r($mini_info);

sleep(5);



// Выводим общую информацию 
        $link = 'https://advert-api.wb.ru/adv/v1/auto/stat?id='.$id_campany;
        $small_info_automatic_campany = light_query_without_data ($token_wb, $link);
echo "<br>";
echo "Просмотров :".$small_info_automatic_campany['views']."<br>";
echo "Кликов :".$small_info_automatic_campany['clicks']."<br>";
echo "ctr :".$small_info_automatic_campany['ctr']."<br>";
echo "cpc :".$small_info_automatic_campany['cpc']."<br>";
echo "Потрачено :".$small_info_automatic_campany['spend']."<br>";

// Выводим информацию по ключевым фразам
		$link = 'https://advert-api.wb.ru/adv/v1/auto/stat-words?id='.$id_campany;
        $info_automatic_campany = light_query_without_data ($token_wb, $link);

echo "<table>";

echo "<tr>";

	echo "<td class=\"stroka\"><b>Поискова фраза</b></td>";
	echo "<td class=\"stroka\"><b>Кол-во  <br> просмотров</b></td>";

echo "</tr>";


foreach ($info_automatic_campany['words']['keywords'] as $keywords) {
	echo "<tr>";
		echo "<td class=\"stroka\">".$keywords['keyword']."</td>";
		echo "<td class=\"stroka\">".$keywords['count'] ."</a></td>";

  


		

	echo "</tr>";

}


echo "<table>";

die();
