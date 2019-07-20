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
    public function getMovies()
    {
        $con = $this->connect();

        $sql    = "SELECT * FROM movies";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['id'];
            $line[] = $result['title'];

            $ret[] = $line;
        }

        return $ret;
    }

    public function getMovieTypeCount()
    {
        $con = $this->connect();

        $sql    = "SELECT movie_type, count(*) AS 'movies_count' FROM movies GROUP BY movie_type";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        $ret[] = array(
            '種別',
            '本数'
        );

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['movie_type'];
            $line[] = $result['movies_count'];

            $ret[] = $line;
        }

        return $ret;
    }

    public function getSpots()
    {
        $con = $this->connect();

        $sql    = "SELECT town, name, lat, lng FROM spots WHERE town = ? ";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute(array($_GET['town']));

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['town'];
            $line[] = $result['name'];
            $line[] = $result['lat'];
            $line[] = $result['lng'];

            $ret[] = $line;
        }

        return $ret;
    }
    
    //指定のテーブルを受け取った際の処理メソッドを追加してね
    //売上のテーブルを取ってくる
    public function getUriage()
    {
        $con = $this->connect();

        $sql    = "SELECT tenpo.住所1,SUM(uriage.合計) FROM tenpo LEFT OUTER JOIN uriage ON tenpo.店舗名=uriage.店舗名 GROUP BY tenpo.住所1 ORDER BY SUM(uriage.合計) DESC";
        $params = array();

        $stmt = $con->prepare($sql);
        $stmt->execute($params);

        $ret = array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $line = array();

            $line[] = $result['住所1'];
            $line[] = $result['SUM(uriage.合計)'];

            $ret[] = $line;
        }

        return $ret;
    }
}
