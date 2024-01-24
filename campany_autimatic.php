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
$info_automatic_campany = get_statistic_automat_advert_campany($token_wb, $id_campany); //Статистика по компаниям "ПОИСК"



// echo "<br>***********************************************************************<br>";
// print_r($info_poisk_campany);


// die();
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
