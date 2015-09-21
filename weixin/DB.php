<?php
include_once("first.php");
/*
 * 数据库操作类
 */
class DB extends First{

       
        static $db_conn;
        
        static function initial() {
                
                self::$db_conn = new PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$pwd);
                self::$db_conn -> query("set names utf8");
                
                return self::$db_conn;
                
        }

        static function insert($sql) {
                $stmt = self::$db_conn->query($sql);
        }

        static function update($sql) {
                $stmt = self::$db_conn->query($sql);
        }

        static function select($sql) {
                $stmt = self::$db_conn->query($sql, PDO::FETCH_ASSOC);
                $item = $stmt->fetch();
                return $item;
        }

        static function selectAll($sql) {
                $stmt = self::$db_conn->query($sql, PDO::FETCH_ASSOC);
                $item = $stmt->fetchAll();
                return $item;
        }

}
DB::initial();
