<?php

/**
 * ルーティング情報用クラス。
 * 自身を配列で保持している点に注意。
 * Class Route
 */
class hagiApiService
{
    /**
     * DB接続
     * @return PDO
     */
    private function connect()
    {
        // 文字化け対策
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");

        // データベースの接続
        try {

            $con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $options);

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $con;
    }

    /**
     * 作品情報
     * @return array
     */
   

   
    
    //指定のテーブルを受け取った際の処理メソッドを追加してね
    //売上のテーブルを取ってくる
    public function getUriage()
    {
        $con = $this->connect();
        $sql    = "SELECT uriage.店舗名,uriage.年度,uriage.月,uriage.合計 FROM uriage";
        $params = array();
        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();
            $line[] = $result['店舗名'];
			$line[] = $result['年度'];
			$line[] = $result['月'];
            $line[] = $result['合計'];
           

            $ret[] = $line;
        }

        return $ret;
    }
}
