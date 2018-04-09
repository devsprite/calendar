<?php

use Calendar\EventValidator;

require('../src/bootstrap.php');
render('header', ['title' => 'Ajouter un évènement']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $validator = new EventValidator();
    $errors = $validator->validates($_POST);

    if (empty($errors)) {

    }

}


?>

    <div class="container">
        <h1>Ajouter un évènement</h1>
        <form action="" method="post" class="form">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input type="text" name="name" id="name" class="form-control" value="Test démo" required>
                        <?php if ($errors['name']): ?>
                        <p class="help-block"><?=$errors['name'];?></p>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="2018-04-09" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="start">Démarrage</label>
                        <input type="time" name="start" id="start" class="form-control" placeholder="HH:MM"
                               value="18:00" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="end">Fin</label>
                        <input type="time" name="end" id="end" class="form-control" placeholder="HH:MM" value="19:00"
                               required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Ajouter l'évènement</button>
            </div>

        </form>
    </div>


<?php render('footer');
