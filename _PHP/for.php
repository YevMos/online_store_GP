<?php

function fgToCl()
{
    $endInFr = 50;
    for ($i = -50; $i <= $endInFr; $i++) {
        $inCl = (($i - 32) * 5) / 9;
        echo round($inCl, 2) . "<br>";
    }
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
<?php fgToCl(); ?>
</body>
</html>
