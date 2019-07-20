<?php

/**
 * ルーティング情報用クラス。
 * 自身を配列で保持している点に注意。
 * Class Route
 */
class ApiService
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
    public function getOtodosi()
    {
        $con = $this->connect();

        $sql = "SELECT tenpo.住所1 AS 県名 ,COUNT(DISTINCT tenpo.店舗名) AS 店舗数 , SUM(uriage.合計) AS 売上額
        FROM tenpo,uriage
        WHERE tenpo.店舗名 = uriage.店舗名
        AND uriage.年度 = 2016
        GROUP BY 県名
        ORDER BY 売上額 DESC";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['県名'];
            $line[] = $result['店舗数'];
            $line[] = $result['売上額'];


            $ret[] = $line;
        }

        return $ret;
    }

    public function getKyonen()
    {
        $con = $this->connect();

        $sql = "SELECT tenpo.住所1 AS 県名 ,COUNT(DISTINCT tenpo.店舗名) AS 店舗数 , SUM(uriage.合計) AS 売上額
        FROM tenpo,uriage
        WHERE tenpo.店舗名 = uriage.店舗名
        AND uriage.年度 = 2017
        GROUP BY 県名
        ORDER BY 売上額 DESC";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['県名'];
            $line[] = $result['店舗数'];
            $line[] = $result['売上額'];


            $ret[] = $line;
        }

        return $ret;
    }
    public function getKotosi()
    {
        $con = $this->connect();

        $sql = "SELECT tenpo.住所1 AS 県名 ,COUNT(DISTINCT tenpo.店舗名) AS 店舗数 , SUM(uriage.合計) AS 売上額
        FROM tenpo,uriage
        WHERE tenpo.店舗名 = uriage.店舗名
        AND uriage.年度 = 2018
        GROUP BY 県名
        ORDER BY 売上額 DESC";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['県名'];
            $line[] = $result['店舗数'];
            $line[] = $result['売上額'];


            $ret[] = $line;
        }

        return $ret;
    }
}
