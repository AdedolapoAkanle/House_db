<?php


class Houses extends Database
{
    public $name;
    public $type;
    public $address;
    public $status;
    public $table = "house";
    public $result;

    public function houseInfo($conditions = "", $field = "*", $column = "")
    {
        return $this->lookUp($this->table, $field, $conditions, $column);
    }

    public function countUserRows($conditions)
    {
        return $this->countRows($this->table, "*", $conditions);
    }

    public function isExists($conditions)
    {
        $rlt = $this->countUserRows($conditions);
        if ($rlt > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function singleHouseInfo($id)
    {
        $this->result = $this->houseInfo("id = '$id'");
        $this->name = $this->result['name'];
        $this->type = $this->result['type'];
        $this->address = $this->result['address'];
        $this->status = $this->result['status'];
    }

    public function houseResult($id)
    {
        $this->singleHouseInfo($id);
        return $this->result;
    }
    public function houseName($id)
    {
        $this->singleHouseInfo($id);
        return $this->name;
    }

    public function houseType($id)
    {
        $this->singleHouseInfo($id);
        return $this->type;
    }

    public function houseAddress($id)
    {
        $this->singleHouseInfo($id);
        return $this->address;
    }


    public function validateHouse()
    {
        if (Functions::checkEmptyInput([$this->name, $this->address, $this->type])) {
            Functions::redirect("View/index.php", "msg", "None of the fields must be empty");
        }

        if (is_numeric($this->name) || is_numeric($this->type)) {
            Functions::redirect("View/index.php", "msg", "Name or type must be in text only");
        }


        if ($this->isExists("name = '$this->name'")) {
            Functions::redirect("View/index.php", "msg", "This name already exists");
        }
    }

    public function processHouse($name, $type, $address)
    {
        $this->name = $this->escape($name);
        $this->type = $this->escape($type);
        $this->address = $this->escape($address);
        $this->validateHouse();

        $this->saveHouse();
    }

    public function saveHouse()
    {
        $this->save($this->table, "name = '$this->name', type = '$this->type', address = '$this->address'");
    }
}
