<?php

/************************************************************************************************************************************
*************************************  Получаем все рекламные компании   ***************************************************
************************************************************************************************************************************/
function get_all_campanies($token_reklama, $status ) {
       $link_wb = 'https://advert-api.wb.ru/adv/v1/promotion/count';
    
    $res = light_query_without_data ($token_reklama, $link_wb);


/// делаем сортировку по статусу
    foreach ($res['adverts'] as $items) {
		$advert_list = $items['advert_list'];
    	for  ($i = 0; $i < count($advert_list); $i++) {
            $advert_list[$i]['type'] = $items['type'];  // 
			$advert_company[$items['status']][] = $advert_list[$i];
 		}
}	
//     echo "<pre>";
// print_r($advert_company);
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
        if ($status <> 0) {
            return $advert_company[$status]; // возвращаем весь массив с указанным статусом
        } else {
            return $advert_company; // возвращаем весь массив
        }
}


/************************************************************************************************************************************
*************************************  Получаем все рекламные компании   ***************************************************
************************************************************************************************************************************/
function get_info_about_advert_campany($token_reklama, $id_campany) {
    // echo "<br>";
 $link = 'https://advert-api.wb.ru/adv/v0/advert?id='.$id_campany;
 $res = light_query_without_data ($token_reklama, $link);

return $res;
}


/************************************************************************************************************************************
*************************************  Статистика поисковых рекламных компаний   ***************************************************
************************************************************************************************************************************/
function get_statistic_poisk_advert_campany($token_reklama, $id_campany) {
echo "<br>";
    $link = 'https://advert-api.wb.ru/adv/v1/stat/words?id='.$id_campany;
    $res = light_query_without_data ($token_reklama, $link);
    
    return $res;
    }

/************************************************************************************************************************************
*************************************  Статистика поисковых + Каталог рекламных компаний   ***************************************************
************************************************************************************************************************************/
function get_statistic_poisk_plus_catalog_advert_campany($token_reklama, $id_campany) {
    echo "<br>";
        $link = 'https://advert-api.wb.ru/adv/v1/seacat/stat?id='.$id_campany;
        $res = light_query_without_data ($token_reklama, $link);
        
        return $res;
        }

        
/************************************************************************************************************************************
*************************************  Статистика Автоматической рекламной компании   ***************************************************
************************************************************************************************************************************/
function get_MINI_statistic_automat_advert_campany($token_reklama, $id_campany) {
    echo "<br>";
        $link = 'https://advert-api.wb.ru/adv/v1/auto/stat?id='.$id_campany;
        $res = light_query_without_data ($token_reklama, $link);
        
        return $res;
        }
/************************************************************************************************************************************
*************************************  Статистика Автоматической рекламной компании   ***************************************************
************************************************************************************************************************************/
function get_statistic_automat_advert_campany($token_reklama, $id_campany) {
    echo "<br>";
        $link = 'https://advert-api.wb.ru/adv/v1/auto/stat-words?id='.$id_campany;
        $res = light_query_without_data ($token_reklama, $link);
        
        return $res;
        }

/************************************************************************************************************************************
*************************************  Полная статистика кампании   ***************************************************
************************************************************************************************************************************/
function get_full_statistic_advert_campany($token_reklama, $id_campany) {
    echo "<br>";
        $link = 'https://advert-api.wb.ru/adv/v1/fullstat?id='.$id_campany;
        $res = light_query_without_data ($token_reklama, $link);
        
        return $res;
        }
    
        

/************************************************************************************************************************************
*************************************  Полная статистика кампании   ***************************************************
************************************************************************************************************************************/
function get_statistic_campany_poisk_date($token_reklama, $id_campany) {

    $data = array((array("id" => 12492619,
		             "interval" => array(
					  		"begin" => "2024-01-01",
						  	  "end" => "2024-01-23")
					)));

// $data_send = json_encode($data, JSON_UNESCAPED_UNICODE);
print_r($data);
die();

file_put_contents('xxx1.json', json_encode($info_about_campany, JSON_UNESCAPED_UNICODE));




$info_about_campany = json_decode(file_get_contents('xxx.json'), true);

        $link = 'https://advert-api.wb.ru/adv/v2/fullstats?id='.$id_campany;
        $res = light_query_with_data($token_wb, $link_wb, $data);
        
        return $res;
        }
    
        