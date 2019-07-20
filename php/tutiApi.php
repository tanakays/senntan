<?php

/* 内部文字エンコーディングをUTF-8に設定 */
mb_internal_encoding("UTF-8");

define('APP_BASE', __DIR__."/data/");

date_default_timezone_set('Asia/Tokyo');

// エラー制御
ini_set( 'display_errors', "1" ); error_reporting(-1);

require "ApiService.php";

/*
 * 環境
 */

define('DB_HOST' , 'localhost');  
define('DB_NAME' , 'sentan');  //※ここでデータベース名を指定
define('DB_USER' , 'root');  
define('DB_PASSWORD', '');

header('Content-Type: text/json; charset=UTF-8');

$app = new ApiService();

$target = $_GET['target'];

$ret = array();

//ここでテーブル名を判断
switch ($target) {
    case 'movies':
        $ret = $app->getMovies();
        break;
    case 'movie_type':
        $ret = $app->getMovieTypeCount();
        break;
    case 'spots':
        $ret = $app->getSpots();
        break;
    case 'uriage':
        $ret = $app->getUriage();
        break;
    default:
        echo "ターゲットが不正です。";
        exit;
}

$obj = new stdClass();
$obj->data = $ret;

echo json_encode($obj);
exit;
