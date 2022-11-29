<?php

namespace src\Models;

use PDO;

class Connection
{
    /**
     * @return PDO
     */
    public static function connect():PDO{
        $pdo = new PDO("mysql:server=localhost;dbname=scandi",'root','root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * @param $query
     * @param array $params
     * @return array|bool
     */
    public static function query($query, array $params = []):array|bool{
        $stmt = self::connect()->prepare($query);
        $check = $stmt->execute($params);
        if(explode(' ',$query)[0 == 'SELECT']){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $check;
    }
}
