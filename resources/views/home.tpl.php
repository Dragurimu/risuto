<?php

/** Opciones */
$hasPath = 'home';

/** Sistema de consulta privado */
$opts = array(
    'method' => [
        '*'
    ]
);

$jwt = jwt_logged($opts);


?>
<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="theme-color" content="#23272A">

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Overpass:400,600,700,800" rel="stylesheet">
    <link href="/assets/css/styles.min.css" rel="stylesheet">
    <link href="/assets/css/music.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 antialiased font-sans flex flex-col h-full">
    <!-- Header -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/layouts/header.tpl.php' ?>

    <!-- Content -->
    <section class="flex-1">
        <div class="container max-w-full" style="height: 15vh; max-height: 175px;"></div>

        <div class="container max-w-2xl mx-auto px-4 md:px-0">
            <div id="risuto"></div>
        </div>

    </section>

    <!-- Footer -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/layouts/footer.tpl.php' ?>

</body>

<!-- Menu -->
<script src="/assets/js/vue.min.js"></script>
<script src="/assets/js/site.min.js"></script>

<script src="/assets/js/music.min.js"></script>

<script>
    var init = (function() {
        var establish = async function() {
            var data = await response();

            const ap = new APlayer({
                container: document.getElementById('risuto'),
                lrcType: 3,
                audio: [...data]
            });
        }

        var response = async function() {

            const rawResponse = await fetch('/api/songs', {
                method: 'get',
                headers: {
                    'Accept': 'application/json'
                }
            });
            const content = await rawResponse.json();

            /** Return */
            return content.data;
        }

        var init = function() {
            establish();
        };

        /** Init */
        window.onload = init();
    }());
</script>

</html>