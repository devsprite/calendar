<?php

use Calendar\EventValidator;

require('../src/bootstrap.php');
render('header', ['title' => 'Ajouter un évènement']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $data = $_POST;
    $validator = new EventValidator();
    $errors = $validator->validates($data);

    if(empty($errors)){
        $event = new \Calendar\Event();
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
        $events = new \Calendar\Events(get_pdo());
        $events->create($event);
        header('Location: index.php?success=1');
        exit;
    }

}


?>


    <div class="container">
        <?php if(!empty($errors)) : ?>
            <div class="alert alert-danger">
                Merci de corriger les champs ci-dessous
            </div>
        <?php endif ?>
        <h1>Ajouter un évènement</h1>
        <form action="" method="post" class="form">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?=(isset($data['name'])) ? h($data['name']) : 'Test démo'; ?>" required>
                        <?php if (isset($errors['name'])) : ?><small class="form-text text-muted"><?=$errors['name'];?></small><?php endif ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="<?=(isset($data['date'])) ? h($data['date']) : '2018-04-02'; ?>" required>
                        <?php if (isset($errors['date'])) : ?><small class="form-text text-muted"><?=$errors['date'];?></small><?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="start">Démarrage</label>
                        <input type="time" name="start" id="start" class="form-control" placeholder="HH:MM" value="<?=(isset($data['start'])) ? h($data['start']) : '18:00'; ?>" required>
                        <?php if (isset($errors['start'])) : ?><small class="form-text text-muted"><?=$errors['start'];?></small><?php endif ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="end">Fin</label>
                        <input type="time" name="end" id="end" class="form-control" placeholder="HH:MM" value="<?=(isset($data['end'])) ? h($data['end']) : '19:00'; ?>" required>
                        <?php if (isset($errors['end'])) : ?><small class="form-text text-muted"><?=$errors['end'];?></small><?php endif ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"><?=(isset($data['description'])) ? h($data['description']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Ajouter l'évènement</button>
            </div>

        </form>
    </div>


<?php render('footer');
