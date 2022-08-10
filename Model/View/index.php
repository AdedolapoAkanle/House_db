<?php
require("../db.php");
require("Controller/house.php");
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
        <input type="text" name="name" /><br>
        <label for="type">Type:</label><br>
        <input type="text" name="type" /><br>
        <label for="address">Address:</label><br>
        <input type="text" name="address" /><br>
        <input type="submit" name="submit">

    </form>

    <table>
        <?php


        $info = new Houses;
        $res = $info->houseInfo();

        if (!empty($res)) {
            foreach ($res as $row) {
                echo "<tr>
		<td>{$row['name']} </td>
		<td>{$row['type']}</td>
		<td>{$row['address']}</td>
	  </tr>";
            }
        }

        ?>
    </table>
</body>

</html>