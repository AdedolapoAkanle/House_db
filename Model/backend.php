<?php
require("../Model/db.php");
require("../Model/View/Controller/house.php");
require("../Model/View/Controller/window.php");
require("../Model/View/Controller/functions.php");

$house = new Houses();
$window = new Windows();
// $dropdown = new Database();


if ($_POST['submit']) {
    $house->processHouse($_POST['name'], $_POST['type'], $_POST['address']);
    Functions::redirect("../Model/View/index.php", "msg", "Successful!");
}

if ($_POST['submit_window']) {
    $window->processWindow($_POST['name'], $_POST['width'], $_POST['height']);
    Functions::redirect("../Model/View/view.php", "msg", "Successful!");
}

if ($_POST['window_name']) {
    Functions::dynamicDropdown("window_name", "window", "name", "Name", "", "name");
    Functions::redirect("../Model/View/view.php", "msg", "Successful!");
}