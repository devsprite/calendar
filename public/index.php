<?php

use App\Month;

require ('../src/Month.php');

try {
    $month = new Month(1, 2018);
} catch (Exception $e) {
    echo $e;
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Calendar</title>
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-3">
    <a href="index.php" class="navbar-brand">Mon calendrier</a>
</nav>

<h1>Mars 2018</h1>

</body>
</html>