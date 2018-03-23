<?php
$meals = array(
    "hamburger" => 4.95,
    "shake" => 1.95,
    "cola" => 0.85
);
$price = $meals["hamburger"] * 2 + $meals["shake"] + $meals["cola"];
$tax = ($price * 7.5) / 100;
$tip = (($price + $tax) * 16) / 100;
$totalPrice = round($price + $tax + $tip, 2);

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
<tbody>
<table>
    <?php foreach ($meals as $meal => $price): ?>
      <tr>
        <td> <?= $meal ?>:</td>
        <td> <?= $price ?> </td>
      </tr>
    <?php endforeach; ?>
  <tr>
    <th>Total:</th>
  </tr>
  <tr>
    <td>Tax: <?= $tax ?></td>
    <td>Tips: <?= $tip ?></td>
    <td>
      Total price: <?= $totalPrice ?>
    </td>
  </tr>
</table>
</tbody>
</body>
</html>
