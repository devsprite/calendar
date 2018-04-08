<?php

use App\Month;

require('../src/Month.php');

try {
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
} catch (Exception $e) {
    echo $e->getMessage();
}
$start = $month->getStartingDay()->modify('last monday');

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
    <link rel="stylesheet" href="css/calendar.css">
    <title>Calendar</title>
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-3">
    <a href="index.php" class="navbar-brand">Mon calendrier</a>
</nav>

<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h1><?= $month->toString(); ?></h1>

    <div>
        <a href="index.php?month=<?= $month->previousMonth()->getMonth(); ?>&year=<?=$month->previousMonth()->getYear(); ?>" class="btn btn-primary">&lt;</a>
        <a href="index.php?month=<?= $month->nextMonth()->getMonth(); ?>&year=<?=$month->nextMonth()->getYear(); ?>" class="btn btn-primary">&gt;</a>
    </div>
</div>

<table class="calendar__table calendar__table_<?= $month->getWeeks() ?>weeks">
    <?php for ($i = 0; $i < $month->getWeeks(); $i++) : ?>
    <tr>
        <?php foreach ($month->days as $key => $day) :
            $date =(clone $start)->modify("+" . ($key + $i * 7) . " days" );
        ?>
        <td>
            <?php if($i === 0) : ?>
            <div class="calendar__weekday"><?= $day; ?></div>
            <?php endif ?>
            <div class="calendar__day <?= $month->withinMonth($date) ? '' : 'calendar__othermonth';?>"><?= $date->format('d'); ?></div>
        </td>
        <?php endforeach; ?>
    </tr>
    <?php endfor ?>
</table>

</body>
</html>