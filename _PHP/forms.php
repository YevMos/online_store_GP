<?php
if (!session_id()) session_start();

function showForm()
{

    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';


    print <<< _HTML
        <form action="" method="post">
            <input type="text" placeholder="name" name="name" value="$name"><br>
            <input type="text" placeholder="surname" name="surname" value="$surname"><br>
            <input type="email" placeholder="email" name="email" value="$email"><br>
            <input type="submit" name="sendForm" value="Send">
        </form>
_HTML;
}

function processForm($params)
{
    $errors = validateForm($params);
    print_r($params);
    print_r($errors);

    if ($params && !$errors) {
        $name = trim(htmlentities($params['name']));
        $surname = trim(htmlentities($params['surname']));
        $email = trim(htmlentities($params['email']));

        echo "
            <p>Hi $name $surname<br>
            Your email is: $email</p>
            ";
    } else if ($errors) {
        $errors = implode('</li><li>', $errors);
        echo "
            <h2>Change this errors</h2>
            <ul>
                <li>
                $errors
                </li>
            </ul>
        ";
    }
}

function validateForm($params)
{
    $errors = array();

    if ($params) {
        if (strlen($params['name']) < 3) {
            $errors[] = "Your name must contain minimum 3 characters";
        }
        if (strlen($params['surname']) < 3) {
            $errors[] = "Your surname must contain minimum 3 characters";
        }
    }

    return $errors;
}


showForm();

processForm($_POST);

session_destroy();