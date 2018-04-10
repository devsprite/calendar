<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="manifest.json">
    <title><?= (isset($title)) ? h($title) : 'Mon Calendrier'; ?></title>
    <script>;
        if('serviceWorker' in navigator) {
            navigator.serviceWorker
                .register('/sw.js')
                .then(function() { console.log("Service Worker Registered"); });
        }
    </script>;
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-3">
    <a href="index.php" class="navbar-brand">Mon calendrier</a>
</nav>
