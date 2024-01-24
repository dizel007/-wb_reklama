<?php
require_once "func.php";
require_once "tokens/topen.php";
require_once "functions.php";
echo "<link rel=\"stylesheet\" href=\"styles.css\">";


$id_campany = $_GET['id_campany'];

$info_poisk_campany = get_statistic_poisk_advert_campany($token_wb, $id_campany); //Статистика по компаниям "ПОИСК"

// echo "<pre>";
// print_r($info_poisk_campany);


echo "<table>";

echo "<tr>";

	echo "<td class=\"stroka\"><b>Поискова фраза</b></td>";
	echo "<td class=\"stroka\"><b>Кол-во  <br> просмотров</b></td>";
	echo "<td class=\"stroka\"><b>Кол-во <br> кликов</b></td>";
	echo "<td class=\"stroka\"><b>отношение числа <br> кликов к количеству<br> показов. Выражается <br> в процентах</b></td>";
	echo "<td class=\"stroka\"><b>Стоимость <br> клика</b></td>";

    echo "<td class=\"stroka\"><b>Затраты</b></td>";
    echo "<td class=\"stroka\"><b>отношение количества <br> просмотров к количеству <br> уникальных пользователей</b></td>";



echo "</tr>";


foreach ($info_poisk_campany['stat'] as $campany) {
	echo "<tr>";
		echo "<td class=\"stroka\">".$campany['keyword']."</td>";
		echo "<td class=\"stroka\">".$campany['views'] ."</a></td>";
        echo "<td class=\"stroka\">".$campany['clicks'] ."</a></td>";
        echo "<td class=\"stroka\">".$campany['ctr'] ."</a></td>";
	    echo "<td class=\"stroka\">".$campany['cpc']."</td>";
        
        echo "<td class=\"stroka\">".$campany['sum']."</td>";
        echo "<td class=\"stroka\">".$campany['frq']."</td>";
  


		

	echo "</tr>";

}


echo "<table>";

die();
