<?php
define('MODX_API_MODE', true);
require_once('/var/www/www-root/data/mail.ftp-technolight.ru/index.php');
$modx=new modX();
$modx->initialize('web');


$modx->runSnippet('classes');

ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
ini_set('memory_limit', '2000000000');


# создаем объекты для работы с БД и почтой
$record = new rec_bd;
$mail_sender = new mailer;
$ozon_cmd = new ozon_api;
$cmd_1с = new api_1c;

# Выдергиваем номер последнего заказа, по которому уведомляли менеджеров

$record->get_last_order_num();

$url='/v1/order/list';


$time_now=time();
$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$since_test=date("c",$yesterday);

echo "Сейчас у нас $time_now -- вчера - $yesterday -- $since_test <br>";

$to = date("c");

$json=$modx->getChunk('order_list_json',array(
                        'since_date'=>$since_test,
                        'to_date'=>$to                   
                    ));

echo "<br> $url <br> $json";

$get_ex=$modx->runSnippet('curl_ozon',array('url'=>$url,
                                            'json'=>$json
                        ));

$get_arr=json_decode($get_ex, true);

echo "<hr>";
echo "<pre>";
$orders=$get_arr['result']['order_ids'];
$num_orders=count($orders);

$last_order_id=$orders[$num_orders-1];

echo "Всего заказов - $num_orders, последний $last_order_id, уведомляли -". $record->id ."<br><br>";

if($last_order_id-$record->id>0){
    
    # шлем письма
    
    $mail_sender->new_order($last_order_id);
    
    # записываем новый $last_order_id
    
    $record->set_last_order_num($last_order_id);
    
    # получим данные по последнему заказу и выведем на экран
    
    $order_info=$ozon_cmd->get_order_info($last_order_id);
    $order_info_arr=json_decode($order_info, true);
    $order_info_arr=$order_info_arr['result']['items'];
    
    # добавим заказ в 1С
    
    $add_order=$cmd_1с->set_order($last_order_id,$order_info_arr);
    
    # запишем в таблицу orders_ozon_1с, что по этому заказу наш долг перед отечеством выполнен
    
    $record->rec_1c_add_order($last_order_id);
    
    # убеждаемся, что все остальные заказы "протолкнулись в 1С"
}
 # получим данные по последнему заказу и выведем на экран
    $order_info=$ozon_cmd->get_order_info($last_order_id);
    $order_info_arr=json_decode($order_info, true);
    $order_info_arr=$order_info_arr['result']['items'];

print_r($orders);

print_r($order_info_arr);