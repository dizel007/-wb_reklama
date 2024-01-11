<?php

require_once "func.php";
require_once "topen.php";
require_once "functions.php";
echo "<link rel=\"stylesheet\" href=\"styles.css\">";

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
$id_campany = $_GET['id_campany'];
$full_info_about_campany  = get_full_statistic_advert_campany($token_reklama, $id_campany); // полная статистика по компаниям
// echo"<pre>";
// print_r($full_info_about_campany);

// file_put_contents("fullStat.json", json_encode($res1, JSON_UNESCAPED_UNICODE));


// $k = json_decode(file_get_contents("fullStat.json"), true);
// $z = $k[0]; // убрали перывй индекс

// echo "Начало периода : ".$z['begin']."<br>";
// echo "Конец  периода : ".$z['end']."<br>";
// echo "Общее число просмотров : ".$z['views']."<br>";
// echo "Общее число кликов : "        .$z['clicks']."<br>";
// echo "Затраченная сумма : ".$z['sum']."<br>";
// echo "Добавлено в корзину : ".$z['atbs']."<br>";
// echo "Сделано заказов : ".$z['orders']."<br>";
// echo "Количество заказанных товаров : ".$z['shks']."<br>";
// echo "Отношение числа кликов к количеству показов. Выражается в процентах : ".$z['ctr']."<br>";
// echo "Средняя стоимость клика : ".$z['cpc']."<br>";
// echo "Отношение количества заказов к общему количеству посещений кампании : ".$z['cr']."<br>";



// echo "<pre>";


foreach ($full_info_about_campany['days'] as $items) {
// echo "<br><b> ********** ************{{{{{". $items['date'] ."}}}}}}}************ *********** **********</b><br>";
// print_r($items);

shows_advert_day(substr($items['date'], 0,10),$items);
// echo "<br><b> ********** ************ ************ ************ *********** **********</b><br>";
// die();
}

// echo"<pre>";
// print_r($z['days']);
echo "PERED SMERTIU";
die();
function shows_advert_day($date_start, $arr_day_advert)
{
    // Разбивка по номенклатуре (получили все товары, которые у нас были просмотрены)
    foreach ($arr_day_advert['apps'] as $apps) {
        foreach ($apps['nm'] as $nm) {
            $arr_article[$nm['nmId']] = $nm['name'];
        }
    }

  // Формируем массив (СКУ)(ТИП УСТРОЙСТА)(ТОвары) ))
    foreach ($arr_day_advert['apps'] as $apps) {    
        foreach ($arr_article as $sku => $name) {
            foreach ($apps['nm'] as $nm) {
                if ($nm['nmId'] == $sku) {
                    $arr_for_print[$sku][$apps['appType']][] = $nm;
                }
            }
        }
    }

/// Перепаковываем массив, и к каждому товару цепляем Устройство Испольщования
foreach ($arr_for_print as $key => &$items) {
    
    foreach ($items as $key22 => &$items22) {
        if (!isset($key22)) {
            unset($items22);
            
        } else {
        if ($key22 == 1) { $real_key = "K";}
        elseif ($key22 == 32) { $real_key = "A"; }
        elseif ($key22 == 64) { $real_key = "I"; }
        else {
            unset($items22);
            shapka_table ($date_start, $arr_day_advert);
            return 0; ///////////////////////////////////// Выход из функции
        }
        $items22[0]['appType'] = $real_key;
        
        $arr_wwwww[$key][] = $items22[0];
        unset($real_key);
        }

}}

unset($items);

foreach ($arr_wwwww as $key => $items) {
    foreach ($items as $item) {
/////// views //////////////////////////////
            if (!isset($arr_bbbb[$key]['views'])) {
                $arr_bbbb[$key]['views'] = $item['views']."(".$item['appType'].")";
                $arr_bbbb[$key]['clicks'] = $item['clicks']."(".$item['appType'].")";
                $arr_bbbb[$key]['ctr'] = $item['ctr']."(".$item['appType'].")";
                $arr_bbbb[$key]['cpc'] = $item['cpc']."(".$item['appType'].")";
                $arr_bbbb[$key]['sum'] = $item['sum']."(".$item['appType'].")";
                $arr_bbbb[$key]['atbs'] = $item['atbs']."(".$item['appType'].")";
                $arr_bbbb[$key]['orders'] = $item['orders']."(".$item['appType'].")";
                $arr_bbbb[$key]['cr'] = $item['cr']."(".$item['appType'].")";
                $arr_bbbb[$key]['shks'] = $item['shks']."(".$item['appType'].")";
                $arr_bbbb[$key]['sum_price'] = $item['sum_price']."(".$item['appType'].")";
                $arr_bbbb[$key]['name'] = $item['name'];
                $arr_bbbb[$key]['nmId'] = $item['nmId'];



            } else {
                $arr_bbbb[$key]['views'] = $arr_bbbb[$key]['views']."<br>". $item['views']."(".$item['appType'].")";
                $arr_bbbb[$key]['clicks'] = $arr_bbbb[$key]['clicks']."<br>". $item['clicks']."(".$item['appType'].")";
                $arr_bbbb[$key]['ctr'] = $arr_bbbb[$key]['ctr']."<br>". $item['ctr']."(".$item['appType'].")";
                $arr_bbbb[$key]['cpc'] = $arr_bbbb[$key]['cpc']."<br>". $item['cpc']."(".$item['appType'].")";
                $arr_bbbb[$key]['sum'] = $arr_bbbb[$key]['sum']."<br>". $item['sum']."(".$item['appType'].")";
                $arr_bbbb[$key]['atbs'] = $arr_bbbb[$key]['atbs']."<br>". $item['atbs']."(".$item['appType'].")";
                $arr_bbbb[$key]['orders'] = $arr_bbbb[$key]['orders']."<br>". $item['orders']."(".$item['appType'].")";
                $arr_bbbb[$key]['cr'] = $arr_bbbb[$key]['cr']."<br>". $item['cr']."(".$item['appType'].")";
                $arr_bbbb[$key]['shks'] = $arr_bbbb[$key]['shks']."<br>". $item['shks']."(".$item['appType'].")";
                $arr_bbbb[$key]['sum_price'] = $arr_bbbb[$key]['sum_price']."<br>". $item['sum_price']."(".$item['appType'].")";
             }

    }
}

unset($item);

// Выводим Таблицу на экран

shapka_table ($date_start, $arr_day_advert);

foreach ($arr_bbbb as $item) {
print_row_table($item);
}
echo "</table>";
} /// END FUNC



function shapka_table ($date_start, $arr_day_advert) {
echo <<<HTML
<table>
<tr >
    <td colspan="12" class="stroka first_stroka"><b>$date_start</b></td>
</tr>

<tr>
<td width = "400" class="stroka"><b>Наименование продукции</b></td>
<td class ="stroka width_td"><b>SKU</b></td>
<td class="stroka width_td"><b>Кол-во <br> просмотров</b></td>
<td class="stroka width_td"><b>Кол-во <br> кликов</b></td>
<td class="stroka width_td"><b>В корзину</b></td>
<td class="stroka width_td"><b>Заказов</b></td>
<td class="stroka width_td"><b>Заказ.<br>товаров</b></td>
<td class="stroka width_td"><b>Сумма<br> рекламы</b></td>
<td class="stroka width_td"><b>Кликов/<br>Показам</b></td>
<td class="stroka width_td"><b>Средняя <br>стоимость клика</b></td>
<td class="stroka width_td"><b>Заказов/<br>посещения</b></td>
<td class="stroka width_td"><b>Сумма <br>заказа</b></td>

</tr>
HTML;


    $arr_row = array(
        'name' => 'ВСЕ ТОВАРЫ',
        'views' => $arr_day_advert['views'],
        'clicks' => $arr_day_advert['clicks'],
        'atbs' => $arr_day_advert['atbs'],
        'orders' => $arr_day_advert['orders'],
        'shks' => $arr_day_advert['shks'],
        'sum' => $arr_day_advert['sum'],
        'ctr' => $arr_day_advert['ctr'],
        'cpc' => $arr_day_advert['cpc'],
        'cr' => $arr_day_advert['cr'],
        'sum_price' => $arr_day_advert['sum_price']
    );

    print_row_table($arr_row);

}




function print_row_table($v)
{
    if (!isset($v['nmId'])) {
        $sku = "";
        $link ="";
    } else {
        $sku = $v['nmId'];
        $link ="https://www.wildberries.ru/catalog/$sku/detail.aspx";
    }

    echo "<tr>";
    
    echo "<td class=\"stroka\">" . $v['name'] ."</b></td>";
    echo "<td class=\"stroka\"> <a href=\"$link\" target=\"_blank\">". $sku."</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['views']). "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['clicks']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['atbs']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['orders']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['shks']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['sum']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['ctr']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['cpc']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['cr']) . "</b></td>";
    echo "<td class=\"stroka\">" . delete_zero_row($v['sum_price']) . "</b></td>";



    echo "</tr>";
}




// Функция очистки Нулей из Таблицы (так лучше видно данные )
function delete_zero_row($row){ 
    $row_temp = preg_replace('/[^0-9.]+/', '', $row);
    if ($row_temp == 0) {
        return "-" ;
    }
        else  {
            return $row;
        }

 
    
}