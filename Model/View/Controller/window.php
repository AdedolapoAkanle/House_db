<?php

class Windows extends Houses
{

    public $name;
    public $width;
    public $height;
    public $status;
    public $table = "window";
    public $result;


    public function windowInfo($condition = "", $field = "*", $column = "")
    {
        return $this->lookUp($this->table, $field, $condition, $column);
    }

    public function singleWindowInfo($id)
    {
        $this->result = $this->windowInfo("id = '$id'");
        $this->name = $this->result['name'];
        $this->width = $this->result['width'];
        $this->height = $this->result['height'];
        $this->status = $this->result['status'];
    }

    public function windowResult($id)
    {
        $this->singleWIndowInfo($id);
        return $this->result;
    }
    public function windowName($id)
    {
        $this->singleWIndowInfo($id);
        return $this->name;
    }
    public function windowWidth($id)
    {
        $this->singleWIndowInfo($id);
        return $this->width;
    }
    public function windowHeight($id)
    {
        $this->singleWIndowInfo($id);
        return $this->height;
    }


    public function validateWindow()
    {
        if (Functions::checkEmptyInput([$this->name, $this->width, $this->height])) {
            Functions::redirect("View/view.php", "msg", "None of the fields must be empty");
        }

        if (is_numeric($this->name)) {
            Functions::redirect("View/view.php", "msg", "Type must be in text only");
        }

        if (!is_numeric($this->width) || !is_numeric($this->height)) {
            Functions::redirect("View/view.php", "msg", "Size must be numeric");
        }

        if ($this->isExists("type = '$this->name'")) {
            Functions::redirect("View/view.php", "msg", "This type already exists");
        }
    }
    public function processWindow($name, $width, $height)
    {
        $this->name = $this->escape($name);
        $this->width = $this->escape($width);
        $this->height = $this->escape($height);

        $this->validateWindow();
        $this->saveWindow();
    }

    public function saveWindow()
    {
        return $this->save($this->table, "name = '$this->name', width = '$this->width', height = '$this->height");
    }
}