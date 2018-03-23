<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=myproj', 'root', '');
} catch (PDOException $exception) {
    echo "cant connect to database: " . $exception->getMessage();
    exit();
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

function getDishesByPrice($price)
{
    $sql = "SELECT * FROM `dishes` WHERE price < $price";

    global $db;
    $query = $db->query($sql);

    return $query;
}

function getDishByName($name)
{
    $sql = "SELECT FROM `dishes` WHERE name = $name";

    global $db;
    $query = $db->query($sql);

    return $query;
}

function getDishesNames()
{
    $sql = "SELECT id, name  FROM `dishes`";

    global $db;
    $query = $db->query($sql);

    return $query;
}

function getDishById($id)
{
    $sql = "SELECT * FROM `dishes` WHERE id = $id";

    global $db;
    $query = $db->query($sql);

    return $query;
}

function insertClient($params = array())
{
    global $db;
    $name = '';
    $surname = '';
    $email = '';
    $preferDish = '';
    $result = false;

    if (isset($params['clientName']) && isset($params['clientSurname']) && isset($params['email'])) {
        $name = htmlentities(trim($params['clientName']));
        $surname = htmlentities(trim($params['clientSurname']));
        $email = htmlentities(trim($params['email']));
        $preferDish = $params['preferDish'];
    }

    if ($name && $surname) {
        $sql = "INSERT INTO `client` VALUES (NULL, ?, ?, ?, ?)";
        $sql = $db->prepare($sql);
        $result = $sql->execute(array($name, $surname, $preferDish, $email));

        var_dump($result);
    }
    return $result;
}

function getClients()
{
    global $db;
    $sql = "SELECT client.id, client.name, client.surname, client.email, client.prefer_dish, dishes.name AS dish_name
            FROM client JOIN dishes WHERE client.prefer_dish = dishes.id";

    $query = $db->query($sql);

    return $query;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
    <select name="dishId" id="">
        <?php $query = getDishesNames(); ?>
        <?php while ($row = $query->fetch()): ?>
            <option value="<?= $row->id ?>"><?= $row->name ?></option>
        <?php endwhile; ?>
        <input type="submit" value="Send">
    </select>
</form>
<style>
    table td, table {
        border: 1px solid #000;
    }

    sup {
        color: red;
    }
</style>
<?php
if (isset($_GET['dishId']))
    $query = getDishById($_GET['dishId']);
    $singleRow = $query->fetch();
?>
<?php if (isset($_GET['dishId'])): ?>
    <table>
        <tr>
            <td><?= $singleRow->id ?></td>
            <td><?= $singleRow->name ?></td>
            <td><?= $singleRow->price ?></td>
            <td><?= $singleRow->is_spicy ?></td>
        </tr>
    </table>
<?php endif; ?>

<br><br>
<!-- ############################################################################### -->
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
    <input type="number" value="<?= $_GET['maxPrice'] ?>" name="maxPrice">
    <input type="submit" value="Send">
</form>
<br>
<?php if (isset($_GET['maxPrice'])): ?>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>spicy</th>
        </tr>
        <?php $query = getDishesByPrice($_GET['maxPrice']) ?>
        <?php while ($row = $query->fetch()): ?>
            <tr>
                <td><?= $row->id ?></td>
                <td> <?= $row->name ?></td>
                <td><?= $row->price ?></td>
                <td>
                    <?php if ($row->is_spicy) {
                        echo "yes";
                    } else {
                        echo "no";
                    } ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
<!-- ############################################################################### -->
<br><br>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="clientName" placeholder="client name"
           value="<?= $_POST['clientName'] ?? '' ?>"><sup>*</sup><br>
    <input type="text" name="clientSurname" placeholder="client surname"
           value="<?= $_POST['clientSurname'] ?? '' ?>"><sup>*</sup><br>
    <input type="email" name="email" placeholder="email" value="<?= $_POST['email'] ?? '' ?>"><br>
    <select name="preferDish" id="">
        <?php $query = getDishesNames(); ?>
        <?php while ($row = $query->fetch()): ?>
            <option value="<?= $row->id ?>"><?= $row->name ?></option>
        <?php endwhile; ?>
    </select>
    <br>
    <input type="submit" value="Add client">
</form>
<?php
$result = null;
if (isset($_POST['clientName']) && isset($_POST['clientSurname'])) {
    $result = insertClient($_POST);
    var_dump($_POST);
} else if ($result === false && isset($_POST['Add client']))
    echo "Ooops, something is wrong :(";
?>
<table>
    <?php $query = getClients() ?>
    <th>Clients</th>
    <?php while ($row = $query->fetch()): ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->name ?></td>
            <td><?= $row->surname ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->dish_name ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>