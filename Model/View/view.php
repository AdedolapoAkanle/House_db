<?php
require("../db.php");
require("Controller/house.php");
require("Controller/window.php");
require("Controller/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bio-Data</title>
</head>

<?php
if (isset($_GET['msg'])) {
    echo $_GET['msg'];
}
?>

<body>

    <form action="../backend.php" method="POST">
        <label for="name">Name:</label><br>
        <?php

        $db = new Database;
        Functions::dynamicDropdown("window_name", "window", "name", "Name", "", "name");
        ?>
        <label for="height">Height:</label><br>
        <input type="text" name="height" /><br>
        <label for="width">Width:</label><br>
        <input type="text" name="width" /><br>
        <input type="submit" name="submit_window">

    </form>

    <table>
        <?php


        $info = new Windows();
        $res = $info->windowInfo();

        if (!empty($res)) {
            foreach ($res as $row) {
                echo "<tr>
        <td>{$row['name']} </td>
		<td>{$row['width']} </td>
		<td>{$row['height']}</td>
	  </tr>";
            }
        }

        ?>
    </table>
</body>

</html>