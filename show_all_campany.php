<?php

function print_all_campany($info_about_campany) {
echo "<link rel=\"stylesheet\" href=\"styles.css\">";
echo "<table>";

echo "<tr>";

	echo "<td class=\"stroka\"><b>Название компании</b></td>";
    echo "<td class=\"stroka\"><b>Старт <br>кампании</b></td>";
    echo "<td class=\"stroka\"><b>Изменена<br>кампания</b></td>";
	echo "<td class=\"stroka\"><b>Фин. информация<br> по компании</b></td>";
	echo "<td class=\"stroka\"><b>Подробная информация<br> по компании</b></td>";
	echo "<td class=\"stroka\"><b>Статус</b></td>";
	echo "<td class=\"stroka\"><b>тип компании</b></td>";

echo "</tr>";


foreach ($info_about_campany as $campany) {
	$id_company = $campany['advertId'];
	echo "<tr>";
		echo "<td class=\"stroka\">".$campany['name']."</td>";
        echo "<td class=\"stroka\">".substr($campany['startTime'], 0,10)."</td>";
        echo "<td class=\"stroka\">".substr($campany['changeTime'], 0,10)."</td>";
        
		echo "<td class=\"stroka\"><a href=\"full_stat.php?id_campany=$id_company\" target=\"_blank\">".$id_company ."</a></td>";
	// для компании ПОИСК 
	if ($campany['type'] == 6) {
		echo "<td class=\"stroka\"><a href=\"campany_poisk.php?id_campany=$id_company\" target=\"_blank\">".$id_company ."</a></td>";
    /// автоматическая компания
	} elseif ($campany['type'] == 8) {
		echo "<td class=\"stroka\"><a href=\"campany_autimatic.php?id_campany=$id_company\" target=\"_blank\">".$id_company ."</a></td>";
    // для кампании поиск + каталог
	}  elseif ($campany['type'] == 9) {
		echo "<td class=\"stroka\"><a href=\"campany_poisk_plus_catalog.php?id_campany=$id_company\" target=\"_blank\">".$id_company ."</a></td>";
	}	else {
		echo "<td class=\"stroka\">".$campany['type']."</td>";
	}
		echo "<td class=\"stroka\">".$campany['status']."</td>";
		echo "<td class=\"stroka\">".print_campany_type($campany['type'])."</td>";

	echo "</tr>";

}


echo "<table>";

}

function print_campany_type($type){
	if ($type == 4)  {
		return "кампания в каталоге";
	} elseif ($type == 5)  {
		return "кампания в карточке товара";
	} elseif ($type == 6)  {
		return "Поиск";
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

