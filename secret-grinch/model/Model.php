<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . "/App/DB/DB.php";

// src="./img/grinch.webp";
require_once "../model/DB.php";

abstract class Model
{
    public static $table;

    public static function get_all()
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "SELECT * FROM $table";
            $req = $connect->prepare($sql);
            $req->execute();
            $connect = null;
            return $req->fetchAll();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public static function get_one(int $id)
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "SELECT * FROM $table WHERE id = :id";
            $req = $connect->prepare($sql);
            $req->execute(["id" => $id]);
            $connect = null;
            return $req->fetch();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }
    public static function get_by_name(string $name)
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "SELECT * FROM $table WHERE name = :name";
            $req = $connect->prepare($sql);
            $req->execute( ["name" => $name]);
            $connect = null;
            return $req->fetch();
            // echo "<br>";
            // echo "you did it";
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }


    public static function add(array $data)
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "INSERT INTO $table ";
            $keys = array_keys($data);
            $count_keys = count($keys);
            $keys_str = implode(",", $keys);
            $sql .= " ($keys_str) VALUES (";
            for ($i = 0; $i < $count_keys; $i++) {
                $sql .= "?,";
            }
            $sql = substr($sql, 0, -1); // убираем лишнюю ,
            $sql .= ")";

            $req = $connect->prepare($sql);
            $req->execute(array_values($data));
            $connect = null;
            return $req->rowCount();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public static function delete(array $params = [])
    {
        try {
            $exec = [];
            $table = static::$table;
            $sql = "DELETE FROM $table ";
            if ($params) { // если параметры есть
                $sql .= " WHERE ";
                foreach ($params as $param) {
                    $key = $param[0];
                    $oper = $param[1];
                    $value = $param[2];
                    $logic = isset($param[3]) ? $param[3] : ""; // лог оператор
                    array_push($exec, $value);
                    // $sql .= " $key $oper ? $logic";
                    $sql .= " $key $oper $value $logic";
                }
            }
            $connect = DB::connect();
            $req = $connect->prepare($sql);
            // $req->execute($exec);
            $req->execute();
            $connect = null;
            // echo $sql;
            // echo "<br>";
            // return $req->rowCount();
            return $sql;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    // UPDATE таблица SET кол1 = значение1, ... (WHERE name = Иван, ...)
    // UPDATE `classrooms` SET `number`='[value-2]',`name`='[value-3]',`count_of_places`='[value-4]' WHERE 1
    /*
    $params = [
        ["number", 188],
        ["name", "Естествознание", ],
        ["count_of_places", 38]
        ["Where", "id", "=", "10"]
    ];
    */
    public static function update(array $data, array $params = [])
    {
        try {
            $table = static::$table;
            $sql = "UPDATE $table SET ";
            $exec = [];
            foreach ($data as $key => $value) {
                $sql .= "$key = ?,";
                array_push($exec, $value);
            }
            $sql = substr($sql, 0, -1);
            if ($params) {
                $sql .= " WHERE ";
                foreach ($params as $param) {
                    $key = $param[0];
                    $oper = $param[1];
                    $value = $param[2];
                    $type_value = $param[3];
                    $logic = isset($param[4]) ? $param[4] : ""; // лог оператор
                    if ($type_value == 'system') {
                        $sql .= " $key $oper $value $logic";
                    } else if ($type_value == 'value') {
                        array_push($exec, $value);
                        $sql .= " $key $oper ? $logic";
                    }
                }
            }
            $connect = DB::connect();
            $req = $connect->prepare($sql);
            $req->execute($exec);
            $connect = null;
            return $req->rowCount();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }


    public static function sellect (string $what_to_sellect, array $params) {

    }
    // SELECT (что взять...) FROM (таблицы ?JOIN?) (WHERE ключ оператор значение (лог оператор) ) (SORTED BY колонка тип сортировки) (LIMIT OFFSET)
    public static function query(array $get, string $fetch_mode = "all", array $tables = [], array $params = [], array $sorted = [], int|null $limit = null, int|null $offset = null)
    {
        try {
            $sql = "SELECT ";
            $exec = [];
            $table = static::$table;
            $sql .= implode(",", $get);
            $sql .= " FROM ";
            if ($tables) {
                $sql .= implode(" JOIN ", $tables);
            } else {
                $sql .= " $table ";
            }
            if ($params) {
                $sql .= " WHERE ";
                foreach ($params as $param) {
                    $key = $param[0];
                    $oper = $param[1];
                    $value = $param[2];
                    $type_value = $param[3];
                    $logic = isset($param[4]) ? $param[4] : ""; // лог оператор
                    if ($type_value == 'system') {
                        $sql .= " $key $oper $value $logic ";
                    } else if ($type_value == 'value') {
                        array_push($exec, $value);
                        $sql .= " $key $oper ? $logic ";
                    }
                }
            }
            if ($sorted) {
                $sql .= " ORDER BY {$sorted['col']} {$sorted['type']} ";
            }
            if ($limit) {
                $sql .= " LIMIT $limit ";
            }
            if ($offset) {
                $sql .= " OFFSET $offset ";
            }
            $connect = DB::connect();
            $req = $connect->prepare($sql);
            // echo $sql;
            // echo "<br>";
            $req->execute($exec);
            $connect = null;
            if ($fetch_mode == "all") {
                return $req->fetchAll();
            } else if ($fetch_mode == "one") {
                return $req->fetch();
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }
}

