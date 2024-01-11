<?php
require_once "func.php";
require_once "topen.php";
require_once "functions.php";
echo "<link rel=\"stylesheet\" href=\"styles.css\">";


$id_campany = $_GET['id_campany'];

$info_poisk_plus_catalog_campany =  get_statistic_poisk_plus_catalog_advert_campany($token_reklama, $id_campany); //Статистика по компаниям "ПОИСК"

// echo "<pre>";
// print_r($info_poisk_plus_catalog_campany);

// die();
echo "<table>";

echo "<tr>";
    echo "<td class=\"stroka\"><b>Тип кампании</b></td>";
	echo "<td class=\"stroka\"><b>Суммарное количество<br> просмотров</b></td>";
	echo "<td class=\"stroka\"><b>Суммарное количество<br> кликов</b></td>";
	echo "<td class=\"stroka\"><b>Суммарное количество<br> заказов</b></td>";
	echo "<td class=\"stroka\"><b>Суммарные затраты</b></td>";
echo "</tr>";

echo "<tr>";
    echo "<td class=\"stroka\"><b>Поиск + каталог</b></td>";
	echo "<td class=\"stroka\"><b>".$info_poisk_plus_catalog_campany['totalViews']."</b></td>";
	echo "<td class=\"stroka\"><b>".$info_poisk_plus_catalog_campany['totalClicks']."</b></td>";
    echo "<td class=\"stroka\"><b>".$info_poisk_plus_catalog_campany['totalOrders']."</b></td>";
    echo "<td class=\"stroka\"><b>".$info_poisk_plus_catalog_campany['totalSum']."</b></td>";
echo "</tr>";

foreach ($info_poisk_plus_catalog_campany['dates'] as $campany) {
    $date_start = $campany['date'];
 echo <<<HTML
    <tr>
     <td colspan="5" class="stroka first_stroka"><b>$date_start</b></td>
    </tr>
HTML;
/// ДАННЫЕ по поиску
echo "<tr>";
        echo "<td class=\"stroka\"><b>ПОИСК</b></td>";
		echo "<td class=\"stroka\">".$campany['search']['views']."</td>";
        echo "<td class=\"stroka\">".$campany['search']['clicks']."</td>";
        echo "<td class=\"stroka\">".$campany['search']['orders']."</td>";
        echo "<td class=\"stroka\">".$campany['search']['sum']."</td>";

	echo "</tr>";
/// ДАННЫЕ по каталогу
echo "<tr>";
        echo "<td class=\"stroka\"><b>КАТАЛОГ</b></td>";
        echo "<td class=\"stroka\">".$campany['catalog']['views']."</td>";
        echo "<td class=\"stroka\">".$campany['catalog']['clicks']."</td>";
        echo "<td class=\"stroka\">".$campany['catalog']['orders']."</td>";
        echo "<td class=\"stroka\">".$campany['catalog']['sum']."</td>";
echo "</tr>";



}


echo "<table>";

die();
