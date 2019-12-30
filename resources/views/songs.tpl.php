<?php

/** Opciones */
$hasPath = 'songs';

/** Sistema de consulta privado */
$opts = array(
    'method' => [
        'p_songs'
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
</head>

<body class="bg-gray-100 antialiased font-sans flex flex-col h-full">
    <!-- Header -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/layouts/header.tpl.php' ?>

    <!-- Content -->
    <section class="flex-1">
        <div class="container max-w-full" style="height: 15vh; max-height: 175px;"></div>

        <div class="container max-w-2xl mx-auto px-4 md:px-0">
            <div class="no-underline bg-white transition shadow-lg hover:shadow hover:-translateY-sm rounded-lg overflow-hidden">
                <div class="items-center px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                    <form id="songs">
                        <div class="flex flex-no-wrap justify-start">
                            <label class="w-1/2 block mr-2">
                                <span class="text-gray-700">Name</span>
                                <input class="form-input mt-1 block w-full" placeholder="Name of the song" name="name">
                            </label>

                            <label class="w-1/2 block mx-2">
                                <span class="text-gray-700">Artist</span>
                                <input class="form-input mt-1 block w-full" placeholder="Artist's name" name="artist">
                            </label>
                        </div>

                        <div class="flex-none md:flex md:flex-no-wrap justify-start">

                            <label class="w-full md:w-1/2 block mt-4 mr-0 md:mr-2">
                                <span class="text-gray-700">Thumbnail</span>
                                <input class="form-input mt-1 block w-full" placeholder="Resource Address" name="cover">
                            </label>

                            <label class="w-full md:w-1/2 block mt-4 mx-0 md:mx-2">
                                <span class="text-gray-700">File</span>
                                <input class="form-input mt-1 block w-full" placeholder="Resource Address" name="url">
                            </label>
                        </div>

                        <div class="w-full">
                            <div class="block pt-4">
                                <button class="w-full bg-gray-800 hover:bg-grey-900 text-white text-sm py-2 px-4 font-semibold rounded focus:outline-none focus:shadow-outline h-10" type="button" onclick="setSong(this);">
                                    Save song
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>

    <!-- Footer -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/layouts/footer.tpl.php' ?>

</body>

<!-- Menu -->
<script src="/assets/js/vue.min.js"></script>
<script src="/assets/js/site.min.js"></script>

<!-- Recursos -->
<script src="/assets/js/axios.min.js"></script>
<script src="/assets/js/sweetalert.min.js"></script>

<!-- Servicios -->
<script src="/assets/js/api.min.js"></script>

<script>
    function handleError(err, reject) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ha ocurrido un error mientras se enviaba la solicitud!',
            footer: '<a href="skype:live:drakgons7ofdragon?chat">Soporte</a>'
        });
    }

    function setSong(el) {
        el.disabled = true;

        /** Data */
        let elements = document.forms['songs'].elements;
        var params = {}

        for (i = 0; i < elements.length; i++) {
            if (elements[i].name) {
                params[elements[i].name] = elements[i].value;
            }
        }

        return new Promise(async (resolve, reject) => {
            try {
                const resp = await api({
                        method: 'post',
                        reference: 'songs',
                        data: params,
                        jwt: '<?php echo $jwt; ?>'
                    })
                    .then(function(response) {
                        /** Metodos */
                        let data = response.data.data;
                        Swal.fire('Ok', data, 'success');

                        for (i = 0; i < elements.length; i++) {
                            if (elements[i].name) {
                                elements[i].value = '';
                            }
                        }

                        el.disabled = false;
                    })
                    .catch(function(error) {
                        el.disabled = false;

                        let data = error.response.data;
                        Swal.fire('Oops', data.errors.title, 'error');
                    });
            } catch (err) {
                handleError(err, reject);
            }
        })
    }
</script>

</html>