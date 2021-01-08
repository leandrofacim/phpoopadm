<?php

namespace App\adms\Models\helper;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

use PDO;
use PDOException;

/**
 * Class de conexão do banco de dados
 *
 * copyrigt (c) year, Leandro Facim
 */
class AdmsConn
{
    public static $host = HOST;
    public static $user = USER;
    public static $pass = PASS;
    public static $dbname = DB_NAME;
    private static $connect = null;

    /**
     * @method Responsavel pela conexão com a base de dados
     * 
     * @return object
     */
    private static function conectar(): object
    {
        try {
            if (self::$connect === null) {
                self::$connect = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname,
                    self::$user,
                    self::$pass
                );
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
        return self::$connect;
    }

    public function getConn()
    {
        return $this->conectar();
    }
}
