<?php
require_once "func.php";
require_once "tokens/topen.php";
// require_once "functions.php";
// require_once "show_fullstat_about_campany.php";
// require_once "show_all_campany.php";



// $info_about_campany = get_statistic_campany_poisk_date11($token_wb, 12492619);
// file_put_contents('xxx22.json', json_encode($info_about_campany, JSON_UNESCAPED_UNICODE));

// $info_about_campany = json_decode(file_get_contents('xxx22.json'), true);

// echo "<pre>";
// print_r($info_about_campany);
$id_campany = $_GET['id_campany']; 

// $id_campany = 12492619;

// проверяем есть ли дата в запросе
if ((isset($_GET['start_date']) && (strlen($_GET['start_date']) <> 0) )) {
     $start_date = ($_GET['start_date']) ;
} else {
    $start_date = date('Y-m-d');
}
// проверяем есть ли дата в запросе
if ((isset($_GET['end_date']) && (strlen($_GET['end_date']) <> 0) )) {
    $end_date = ($_GET['end_date']) ;
} else {
   $end_date = date('Y-m-d');
}



echo <<<HTML
<form action="#" method="get">
  <label for="start_date">Дата начала:</label>
  <input type="date" id="start_date" name="start_date" value = $start_date>
  <label for="end_date">Дата окончания:</label>
  <input type="date" id="end_date" name="end_date" value = $end_date>
  <input hidden type="number" id="id_campany" name="id_campany" value = $id_campany>
  <input type="submit" value="Отправить">
</form>

HTML;




// echo "start_date : {".$start_date ."}<br>";
// echo "end_date : {".$end_date ."}<br>";
// echo "id_campany : {".$id_campany. "}<br>";


// die();

    $data = array((array("id" => (int)$id_campany,
		             "interval" => array(
					  		"begin" => $start_date,
						  	  "end" => $end_date,)
					)));


// die();
$info_about_campany = get_statistic_campany_poisk_date11($token_wb, $id_campany, $data) ;

// echo "<pre>";
// print_r($info_about_campany);

file_put_contents('xxx777.json', json_encode($info_about_campany, JSON_UNESCAPED_UNICODE));

print_detail_info ($info_about_campany);


function get_statistic_campany_poisk_date11($token_wb, $id_campany, $data) {



        $link_wb = 'https://advert-api.wb.ru/adv/v2/fullstats?id='.$id_campany;
        $res = light_query_with_data($token_wb, $link_wb, $data);
        
        return $res;


}




function print_detail_info ($arr_data) {
    
    echo "<link rel=\"stylesheet\" href=\"styles.css\">";
    echo "<table>";

    echo "<tr>";
            echo "<td class=\"stroka\">Наименование </td>";
            echo "<td class=\"stroka\">".'Количество<br>просмотров<br>(views)'."</td>";
            echo "<td class=\"stroka\">".'Количество<br>кликов<br>(clicks)' ."</td>";
            echo "<td class=\"stroka\">".'Отношение числа<br>кликов к количеству<br>показов (ctr) в %'."</td>";
            echo "<td class=\"stroka\">".'Средняя стоимость<br>клика (cpc) руб'."</td>";
            echo "<td class=\"stroka\">".'Затраты<br>(sum) руб'."</td>";
            echo "<td class=\"stroka\">".'Количество<br>добавлений товаров<br>в корзину(atbs)'."</td>";
            echo "<td class=\"stroka\">".'Количество<br>заказов<br>(orders)'."</td>";
            echo "<td class=\"stroka\">".'это отношение кол-ва<br>заказов к общему<br>кол-ву посещений (cr)'."</td>";
            echo "<td class=\"stroka\">".'Количество<br>заказанных<br>товаров(shks)'."</td>";
            echo "<td class=\"stroka\">".'Заказов на<br>сумму (sum_price)'."</td>";
     echo "</tr>";
/*************************************************************************************************/

    $campany =  $arr_data[0];
        echo "<tr>";
        echo "<td class=\"stroka\">Сводная информация за весь период</td>";
            echo "<td class=\"stroka\"><b>".$campany['views'] ."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['clicks'] ."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['ctr'] ."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['cpc']."</b></td>";
            
            echo "<td class=\"stroka\"><b>".$campany['sum']."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['atbs']."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['orders']."</b></td>";

            echo "<td class=\"stroka\"><b>".$campany['cr']."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['shks']."</b></td>";
            echo "<td class=\"stroka\"><b>".$campany['sum_price']."</b></td>";
                
    
        echo "</tr>";
   // Общая за день  
    foreach ($campany['days'] as $item_comp) {
        // echo "<pre>";
        // print_r($arr_data[0]['days'][0]) ;


  echo "<tr>";
         echo "<td class=\"svod_data\" colspan=\"11\">".substr($item_comp['date'], 0,10) ."</td>";
  echo "</tr>";
  echo "<tr>";
        echo "<td class=\"stroka\"></td>";
        echo "<td class=\"stroka\">".'views'."</td>";
        echo "<td class=\"stroka\">".'clicks' ."</td>";
        echo "<td class=\"stroka\">".'ctr'."</td>";
        echo "<td class=\"stroka\">".'cpc'."</td>";
        echo "<td class=\"stroka\">".'sum'."</td>";
        echo "<td class=\"stroka\">".'atbs'."</td>";
        echo "<td class=\"stroka\">".'orders'."</td>";
        echo "<td class=\"stroka\">".'cr'."</td>";
        echo "<td class=\"stroka\">".'shks'."</td>";
        echo "<td class=\"stroka\">".'sum_price'."</td>";
 echo "</tr>";


        echo "<tr>";
        echo "<td class=\"stroka\"></td>";
            echo "<td class=\"stroka\">".$item_comp['views'] ."</td>";
            echo "<td class=\"stroka\">".$item_comp['clicks'] ."</td>";
            echo "<td class=\"stroka\">".$item_comp['ctr'] ."</td>";
            echo "<td class=\"stroka\">".$item_comp['cpc']."</td>";
            
            echo "<td class=\"stroka\">".$item_comp['sum']."</td>";
            echo "<td class=\"stroka\">".$item_comp['atbs']."</td>";
            echo "<td class=\"stroka\">".$item_comp['orders']."</td>";

            echo "<td class=\"stroka\">".$item_comp['cr']."</td>";
            echo "<td class=\"stroka\">".$item_comp['shks']."</td>";
            echo "<td class=\"stroka\">".$item_comp['sum_price']."</td>";
                
    
        echo "</tr>";

    
  //////////////////////////////////////// Выводим информацию по каждому артикулу //////////////////////////////////////
  $unit_array = take_unit_order ($item_comp);
        // echo "<pre>";
        // print_r($item_comp) ;
        // die('lkkkk');

  foreach ($unit_array as $key => $article) {
    $art_views ='';
    $art_views_sum = 0;
    $art_clicks ='';
    $art_clicks_sum = 0;
    $art_orders='';
    $art_orders_sum = 0;
    foreach ($article as $unit) {

/// суммы для ячеек
$art_views_sum = $art_views_sum + $unit['views'];  
$art_clicks_sum = $art_clicks_sum + $unit['clicks'];  
$art_orders_sum = $art_orders_sum + $unit['orders'];  
   // Формируем ячейку с количеством просмотров /кликов /   заказов  
   

   if ($unit['appType'] == 1) {
    ($unit['views']  <> 0) ? $art_views  = $art_views.$unit['views'] ."(К)|": $zz=1;
    ($unit['clicks']  <> 0) ? $art_clicks = $art_clicks.$unit['clicks'] ."(К)|": $zz=1;
    ($unit['orders'] <> 0) ? $art_orders = $art_orders.$unit['orders'] ."(К)|": $zz=1;
        
   } elseif (($unit['appType'] == 32)) {
    ($unit['views']  <> 0) ? $art_views  = $art_views.$unit['views'] ."(A)|": $zz=1;
    ($unit['clicks']  <> 0) ? $art_clicks = $art_clicks.$unit['clicks'] ."(A)|": $zz=1;
    ($unit['orders'] <> 0) ? $art_orders = $art_orders.$unit['orders'] ."(A)|": $zz=1;
        
   } elseif (($unit['appType'] == 64)) {
    ($unit['views']  <> 0) ? $art_views  = $art_views.$unit['views'] ."(I)": $zz=1;
    ($unit['clicks']  <> 0) ? $art_clicks = $art_clicks.$unit['clicks'] ."(I)": $zz=1;
    ($unit['orders'] <> 0) ? $art_orders = $art_orders.$unit['orders'] ."(I)": $zz=1;

        // $art_views  = $art_views.$unit['views']."(I)";
        // $art_clicks = $art_clicks.$unit['clicks']."(I)";
        // $art_orders = $art_orders.$unit['orders']."(I)";
      } 



            // echo "<td class=\"stroka\">".$unit['clicks'] ."</td>";
            // echo "<td class=\"stroka\">".$unit['ctr'] ."</td>";
            // echo "<td class=\"stroka\">".$unit['cpc']."</td>";
            
            // echo "<td class=\"stroka\">".$unit['sum']."</td>";
            // echo "<td class=\"stroka\">".$unit['atbs']."</td>";
            // echo "<td class=\"stroka\">".$unit['orders']."</td>";

            // echo "<td class=\"stroka\">".$unit['cr']."</td>";
            // echo "<td class=\"stroka\">".$unit['shks']."</td>";
            // echo "<td class=\"stroka\">".$unit['sum_price']."</td>";
            // echo "<td class=\"stroka\">".$unit['appType']."</td>";
        
        
    }
    echo "<tr>";
        echo "<td class=\"stroka\">".$unit['name']." <br> ".$unit['nmId']."</td>";
        echo "<td class=\"stroka\"><b>".$art_views_sum."</b><br>".$art_views."</td>";

        echo "<td class=\"stroka\"><b>".$art_clicks_sum."</b><br>".$art_clicks."</td>";

        echo "<td class=\"stroka\">".$unit['ctr'] ."</td>";
        echo "<td class=\"stroka\">".$unit['cpc']."</td>";
        
        echo "<td class=\"stroka\">".$unit['sum']."</td>";
        echo "<td class=\"stroka\">".$unit['atbs']."</td>";
        
        echo "<td class=\"stroka\"><b>".$art_orders_sum."</b><br>".$art_orders."</td>";

        echo "<td class=\"stroka\">".$unit['cr']."</td>";
        echo "<td class=\"stroka\">".$unit['shks']."</td>";
        echo "<td class=\"stroka\">".$unit['sum_price']."</td>";
      
            

    echo "</tr>";




    }
  }
     
  
    
    echo "<table>";


}




// перебираем дневной массив и возвращаем массив отсортированный по товарам и добавляем к нем уустройство входа
function take_unit_order ($arr_items) {
    foreach ($arr_items['apps'] as $unit_item) {
        foreach ($unit_item['nm'] as $item)  {
            $item['appType'] =  $unit_item['appType'];
            $arr_new[$item['nmId']][] = $item;
           }
    }
return  $arr_new;
   } 