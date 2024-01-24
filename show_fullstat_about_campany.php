<?php

require_once "func.php";
require_once "tokens/topen.php";
require_once "functions.php";
require_once "show_fullstat_about_campany.php";
require_once "show_all_campany.php";

// $advertId = $_GET['advertId'];


function print_fullstat_about_campany($info_about_campany) {
echo "<link rel=\"stylesheet\" href=\"styles.css\">";
echo "<table>";

echo "<tr>";

	echo "<td class=\"stroka\"><b>ID компании</b></td>";
    echo "<td class=\"stroka\"><b>дата начала и <br>окончания</b></td>";
    echo "<td class=\"stroka\"><b>Количество<br>просмотров<br>(views)</b></td>";
	echo "<td class=\"stroka\"><b>Количество<br>кликов<br>(clicks)</b></td>";

	echo "<td class=\"stroka\"><b>Отношение числа<br>кликов к количеству <br>показов. Выражается в<br> процентах.(ctr)<br> по компании</b></td>";
	echo "<td class=\"stroka\"><b>Средняя стоимость<br> клика(cpc)</b></td>";
	echo "<td class=\"stroka\"><b>Затраты(sum)</b></td>";
	echo "<td class=\"stroka\"><b>Количество<br> добавлений<br> товаров в<br> корзину.(atbs)</b></td>";
	echo "<td class=\"stroka\"><b>Количество<br>заказов.<br>(orders)</b></td>";
	echo "<td class=\"stroka\"><b>CR</b></td>";
	echo "<td class=\"stroka\"><b>Количество<br>заказанных<br> товаров(shks)</b></td>";
	echo "<td class=\"stroka\"><b>Заказов<br>на сумму<br> (sum_price)</b></td>";

echo "</tr>";


/// Сводные данные по всей таблице 

echo "<tr>";

	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['advertId']."</b></td>";
    echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['interval']['begin']." / ".$info_about_campany['interval']['end']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['views']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['clicks']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['ctr']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['cpc']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['sum']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['atbs']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['orders']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['cr']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['shks']."</b></td>";
	echo "<td class=\"stroka svod_data\"><b>".$info_about_campany['sum_price']."</b></td>";
echo "</tr>";
// пустая строка
echo "<tr>";  
echo "<td> </td>";  
echo "</tr>";

// print_r($info_about_campany);
foreach ($info_about_campany['days'] as $campany) {
 
 // Общие данные за (день) статисктии
    echo "<tr>";
    echo "<td class=\"stroka svod_day_data\"></td>";
    echo "<td class=\"stroka svod_day_data\">".substr($campany['date'], 0,10)."</td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['views']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['clicks']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['ctr']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['cpc']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['sum']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['atbs']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['orders']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['cr']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['shks']."</b></td>";
        echo "<td class=\"stroka svod_day_data\"><b>".$campany['sum_price']."</b></td>";
    echo "</tr>";
// Данные по Артикулам
$arr_days_statistik = get_array_articule_by_apps($campany['apps']);
    foreach ($arr_days_statistik as $key => $prods) {
        echo "<tr>";
    echo "<td class=\"stroka\">$key</td>";
    echo "<td class=\"stroka\">".$prods['name']."</td>";
// views
        $views_sum = @$prods['views'][1]+@$prods['views'][32] + $prods['views'][64];
        ($views_sum > 0)? $views_sum = $views_sum: $views_sum ="-";
        echo "<td class=\"stroka\"><b>".$views_sum.
                                        " (".@$prods['views'][1].")".
                                        " (".@$prods['views'][32].")".
                                        " (".@$prods['views'][64].")".
                                        
                                        "</b></td>";
// click
        $clicks_sum = @$prods['clicks'][1]+@$prods['clicks'][32] + $prods['clicks'][64];
        ($clicks_sum > 0)? $clicks_sum = $clicks_sum: $clicks_sum ="-";
        echo "<td class=\"stroka\"><b>".$clicks_sum.
                                        " (".@$prods['clicks'][1].")".
                                        " (".@$prods['clicks'][32].")".
                                        " (".@$prods['clicks'][64].")".
                                        "</b></td>";


// ctr
        $ctr_sum = @$prods['ctr'][1]+@$prods['ctr'][32] + $prods['ctr'][64];
        ($ctr_sum > 0)? $ctr_sum = $ctr_sum: $ctr_sum ="-";
        echo "<td class=\"stroka\"><b>".$ctr_sum."</b></td>";
// cpc
        $cpc_sum = @$prods['cpc'][1]+@$prods['cpc'][32] + $prods['cpc'][64];
        ($cpc_sum > 0)? $cpc_sum = $cpc_sum: $cpc_sum ="-";
        echo "<td class=\"stroka\"><b>".$cpc_sum."</b></td>";
// sum
    $sum_sum = @$prods['sum'][1]+@$prods['sum'][32] + $prods['sum'][64];
    ($sum_sum > 0)? $sum_sum = $sum_sum: $sum_sum ="-";
    echo "<td class=\"stroka\"><b>".$sum_sum."</b></td>";

// atbs
    // $atbs_sum = @$prods['atbs'][1]+@$prods['atbs'][32] + $prods['atbs'][64];
    // ($atbs_sum > 0)? $atbs_sum = $atbs_sum: $atbs_sum ="-";
    echo "<td class=\"stroka\"><b>". " " . "</b></td>";

// orders
    $orders_sum = @$prods['orders'][1]+@$prods['orders'][32] + $prods['orders'][64];
    ($orders_sum > 0)? $orders_sum = $orders_sum: $orders_sum ="-";
    echo "<td class=\"stroka\"><b>".$orders_sum.
                                " (".@$prods['orders'][1].")".
                                " (".@$prods['orders'][32].")".
                                " (".@$prods['orders'][64].")".
                                "</b></td>";

// cr
    $cr_sum = @$prods['cr'][1]+@$prods['cr'][32] + $prods['cr'][64];
    ($cr_sum > 0)? $cr_sum = $cr_sum: $cr_sum ="-";
    echo "<td class=\"stroka\"><b>".$cr_sum."</b></td>";

// cr
    $shks_sum = @$prods['shks'][1]+@$prods['shks'][32] + $prods['shks'][64];
    ($shks_sum > 0)? $shks_sum = $shks_sum: $shks_sum ="-";
    echo "<td class=\"stroka\"><b>".$shks_sum."</b></td>";

// cr
    $sum_price_sum = @$prods['sum_price'][1]+@$prods['sum_price'][32] + $prods['sum_price'][64];
    ($sum_price_sum > 0)? $sum_price_sum = $sum_price_sum: $sum_price_sum ="-";
    echo "<td class=\"stroka\"><b>".$sum_price_sum."</b></td>";

        // echo "<td class=\"stroka\"><b>".$prods['cr']."</b></td>";
        // echo "<td class=\"stroka\"><b>".$prods['shks']."</b></td>";
        // echo "<td class=\"stroka\"><b>".$prods['sum_price']."</b></td>";
    echo "</tr>";    





    }
// пустая строка
    echo "<tr>";  
    echo "<td> </td>";  
    echo "</tr>";     
}


echo "<table>";

}






function get_array_articule_by_apps($campany_apps) {
// Разбираем массив товаров в зависимости от типа устройства  на котором смотрели

// print_r($campany_apps);
// die();

foreach ($campany_apps as $apps)  {
    foreach ($apps['nm'] as $items)  {

// print_r($campany_apps);
// die();

$appType = $apps['appType'];
        $new_arr_apps[$items['nmId']]['name'] = $items['name'];

        $new_arr_apps[$items['nmId']]['views'][$appType] = $items['views'];
        $new_arr_apps[$items['nmId']]['clicks'][$appType] = $items['clicks'];
        $new_arr_apps[$items['nmId']]['ctr'][$appType] = $items['ctr'];
        $new_arr_apps[$items['nmId']]['cpc'][$appType] = $items['cpc'];
        $new_arr_apps[$items['nmId']]['sum'][$appType] = $items['sum'];
        $new_arr_apps[$items['nmId']]['orders'][$appType] = $items['orders'];
        $new_arr_apps[$items['nmId']]['cr'][$appType] = $items['cr'];
        $new_arr_apps[$items['nmId']]['shks'][$appType] = $items['shks'];
        $new_arr_apps[$items['nmId']]['sum_price'][$appType] = $items['sum_price'];
}
}
// print_r($new_arr_apps);
// die();
return $new_arr_apps;
}

















