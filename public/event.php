<?php

use Calendar\Events;

require('../src/bootstrap.php');


if (!isset($_GET['id'])) {
    e404();
}

$pdo = get_pdo();
$events = new Events($pdo);
try {
    $event = $events->find($_GET['id']);
} catch (Exception $e) {
    e404();
}

render('header', ['title' => $event->getName()]);

?>
<h1><?= h($event->getName()) ?></h1>

<ul>
    <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
    <li>Heure de démarrage: <?= $event->getStart()->format('H:i'); ?></li>
    <li>Heure de fin: <?= $event->getEnd()->format('H:i'); ?></li>
    <li>
        Description: <br>
        <?= h($event->getDescription()); ?>
    </li>
</ul>

<?php require('../views/footer.php'); ?>
