<?php


class Functions extends Database
{

    public static function arrayPrinter($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    public static function redirect($url, $type, $msg)
    {
        header("Location:$url?$type=$msg");
        exit;
    }


    public static function checkEmptyInput($params = [])
    {
        for ($i = 0; $i < sizeof($params); $i++) {
            if (!isset($params[$i]) || empty($params[$i])) {
                return true;
            }
        }
        return false;
    }

    public static function dynamicDropdown($name, $table, $label, $title, $condition = "", $value)
    {

        global $db;
        $data = $db->lookUp($table, "*", $condition);

        echo "<select id = '$name' name = '$name'>";
        echo "<option value =''>Select $title</option>";

        foreach ($data as $rlt) {
            $lab = $rlt[$label];
            $val = $rlt[$value];
            echo "<option value ='$val'>$lab</option>";
        }
        echo "<select/>";
        // echo "<br>";
    }
}