<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=myproj', 'root', '');
} catch (PDOException $exception) {
    $errorsFile = fopen('errors.txt', 'a');
    $error = "cant connect to database: " . $exception->getMessage() . "\r\n";
    fwrite($errorsFile, $error);

    echo "<br><br>ERROR!";

    exit();
}

//$query = $db->query("SELECT * FROM dishes");
//$fhCSV = fopen('dishes.csv', 'a');
//
//while ($row = $query->fetch(PDO::FETCH_NUM)) {
//    fputcsv($fhCSV, $row);
//}

///////////////////////////////////////////////////////////////

$fEmails = fopen('emails.txt', 'r');
$fCountEmails = fopen('emailsCount.txt', 'a');

$emails = array();
$countEmails = array();

while (!feof($fEmails) && $email = fgets($fEmails)) {
    $emails[] = trim($email);
}

foreach ($emails as $email) {
    if (!array_key_exists($email, $countEmails))
        $countEmails[$email] = 1;
    else
        $countEmails[$email] += 1;
}

arsort($countEmails);

foreach ($countEmails as $email => $count) {
    fputs($fCountEmails, "$email | $count \n\r");
}
fclose($fEmails);
fclose($fCountEmails);
///////////////////////////////////////////////////////////

$fCsv = fopen('dishes.csv', 'r');

$dishes = array();

while (!feof($fCsv) && $line = fgetcsv($fCsv)) {
    $dishes[$line[1]] = $line;
}
fclose($fCsv);
//
//echo "<table>";
//echo "<tr><th>Name</th><th>Price</th><th>Spicy</th></tr>";
//foreach ($dishes as $dish => $info) {
//    echo "<tr>";
//    echo "<th>$dish</th>";
//    echo "<td>$info[2]</td>";
//    echo "<td>$info[3]</td>";
//    echo "</tr>";
//}
//echo "</table>";

//////////////////////////////////////////////////////////////

class File
{
    public $fileDescriptor = '';

    public function __construct($filename = '')
    {
        if (file_exists($filename))
            $this->fileDescriptor = fopen($filename, 'r');
    }

    public function closeFile()
    {
        fclose($this->fileDescriptor);
    }

    public function fileGetContest()
    {
        $fileContest = '';

        while (!feof($this->fileDescriptor) && $line = fgets($this->fileDescriptor)) {
            $fileContest .= $line . "\r\n";
        }
        print_r($fileContest);
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
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="fileName">Enter name of file</label><br>
    <input type="text" name="fileName" id="fileName">
    <br>
    <input type="submit" value="Send" name="sendFileName">
    <pre>
    <?php if (isset($_POST['sendFileName'])) {
        $file = new File($_POST['fileName']);

        echo $file->fileGetContest();
    }
    ?>
    </pre>
</form>
</body>
</html>
