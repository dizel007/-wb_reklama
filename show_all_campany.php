<?php

function print_all_campany($info_about_campany) {
echo "<link rel=\"stylesheet\" href=\"styles.css\">";
echo "<table>";

echo "<tr>";

	echo "<td class=\"stroka\"><b>ID кампании</b></td>";
	echo "<td class=\"stroka\"><b>Название кампании</b></td>";
    echo "<td class=\"stroka\"><b>дата начала и <br>изменения</b></td>";
    echo "<td class=\"stroka\"><b>Тип<br>кампании</b></td>";
	echo "<td class=\"stroka\"><b>Статус<br>кампании</b></td>";

	echo "<td class=\"stroka\"><b>Активность<br>фиксированных<br>фраз</b></td>";
	echo "<td class=\"stroka\"><b>Средняя стоимость<br> клика(cpc)</b></td>";
	echo "<td class=\"stroka\"><b>Затраты(sum)</b></td>";
	echo "<td class=\"stroka\"><b>Количество<br> добавлений<br> товаров в<br> корзину.(atbs)</b></td>";
	
echo "</tr>";


foreach ($info_about_campany as $campany) {
	$id_company = $campany['advertId'];
	echo "<tr>";
		echo "<td class=\"stroka\"><a href=\"campany_poisk_buh_stat.php?id_campany=$id_company\" target=\"_blank\">".$campany['advertId']."</a></td>";
		echo "<td class=\"stroka\">".$campany['name']."</td>";
        echo "<td class=\"stroka\">".substr($campany['startTime'], 0,10)."<br> ".substr($campany['changeTime'], 0,10)."</td>";

		$type_campany = print_campany_type($campany['type']);
		if ($campany['type'] == 6) {
			echo "<td class=\"stroka\"><a href=\"campany_poisk.php?id_campany=$id_company\" target=\"_blank\">".$type_campany ."</a></td>";
		/// автоматическая компания
		} elseif ($campany['type'] == 8) {
			echo "<td class=\"stroka\"><a href=\"campany_autimatic.php?id_campany=$id_company\" target=\"_blank\">".$type_campany ."</a></td>";
		// для кампании поиск + каталог
		}  elseif ($campany['type'] == 9) {
			echo "<td class=\"stroka\"><a href=\"campany_poisk_plus_catalog.php?id_campany=$id_company\" target=\"_blank\">".$type_campany ."</a></td>";
		}	else {
			echo "<td class=\"stroka\">".$type_campany."</td>";
		}
		
        $status = print_campany_status($campany['status']);
		echo "<td class=\"stroka\">".$status ."</td>";
if (isset($campany['searchPluseState'])) {
		echo "<td class=\"stroka\">".$campany['searchPluseState'] ."</td>";
} else {
	echo "<td class=\"stroka\"></td>";
}
	// для компании ПОИСК 
	

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

function print_campany_status($status){
	if ($status == 9)  {
		return "идут показы";
	} elseif ($status == 11)  {
		return "кампания на паузе";
	} elseif ($status == 8)  {
		return "отказался";
	} elseif ($status == 7)  {
		return "кампания в рекомендациях на главной странице";
	} elseif ($status == 4)  {
		return "готова к запуску";
	} else {
		return "!!! НЕТ ДАННЫХ";
	}
}
