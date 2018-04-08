<?php

use Calendar\Month;
use Calendar\Events;

require ('../src/bootstrap.php');

$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$pdo = get_pdo();
$events = new Events($pdo);

$weeks = $month->getWeeks();
$start = $month->getStartingDay();
$start = ($start->format('N') === '1') ? $start : $month->getStartingDay()->modify('last monday');
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . ' days');

$events = $events->getEventsBetweenByDays($start, $end);

require ('../views/header.php');
?>


<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h1><?= $month->toString(); ?></h1>

    <div>
        <a href="index.php?month=<?= $month->previousMonth()->getMonth(); ?>&year=<?=$month->previousMonth()->getYear(); ?>" class="btn btn-primary">&lt;</a>
        <a href="index.php?month=<?= $month->nextMonth()->getMonth(); ?>&year=<?=$month->nextMonth()->getYear(); ?>" class="btn btn-primary">&gt;</a>
    </div>
</div>

<table class="calendar__table calendar__table_<?= $weeks ?>weeks">
    <?php for ($i = 0; $i < $weeks; $i++) : ?>
    <tr>
        <?php foreach ($month->days as $key => $day) :
            $date =(clone $start)->modify("+" . ($key + $i * 7) . " days" );
            $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
        ?>
        <td>
            <?php if($i === 0) : ?>
            <div class="calendar__weekday"><?= $day; ?></div>
            <?php endif ?>
            <div class="calendar__day <?= $month->withinMonth($date) ? '' : 'calendar__othermonth';?>"><?= $date->format('d'); ?></div>
            <?php foreach ($eventsForDay as $event) : ?>
            <div class="calendar__event"><?= (new DateTime($event['start']))->format('H:i'); ?> - <a href="event.php?id=<?=$event['id'];?>"><?= h($event['name']);?></a></div>
            <?php endforeach; ?>
        </td>
        <?php endforeach; ?>
    </tr>
    <?php endfor ?>
</table>

<?php require ('../views/footer.php'); ?>
