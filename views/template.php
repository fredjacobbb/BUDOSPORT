<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUDOSPORT</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="node_modules/fontawesome-free/css/all.min.css">
</head>
<body class="bg-dark">

    <header>
        <img class="img header-logo" src="public/assets/img/header_logo.webp" alt="brand_icon">
    </header>

    <nav class="overflow-x-scroll">
        <?= $nav ?>
    </nav>

    <?= $view ?>

    <!-- <footer class="row h-100 bg-red">
        <div class="col-12 col-md-4">
            <p>Nous contacter</p>
            <p></p>
        </div>
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4"></div>
    </footer> -->

    <footer class="container-fluid bg-red text-light pt-5 pb-2 mt-5">
        <div class="row align-items-center justify-content-around">
            <div class="col-md-4 col-12 mb-4">
                <!-- <div class="mw-25">
                    <!-- <img class="img-fluid" src="public/assets/img/header_logo.webp" alt="">
                </div>-->
                <p class="fs-2"><strong>BUDOSPORT 80</strong></p>
                <p>14 rue colbert 80480 AMIENS</p>
                <p><a href="tel:+0612121212" class="text-light text-decoration-none">Tél : 0612121212</a></p>
                <p><a href="mailto:budosport80@gmail.com" class="text-light text-decoration-none">budosport80@gmail.com</a></p>
            </div>
            <div class="col-md-4 col-12 mb-4">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fs-2 fab fa-facebook p-2"></i>
                    <a href="" class="text-light">Facebook</a>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fs-2 fab fa-whatsapp p-2"></i>
                    <a href="" class="text-light">Whatsapp</a>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fs-2 fab fa-instagram p-2"></i>
                    <a href="" class="text-light">Instagram</a>
                </div>
            </div>
        </div>
        <p class="text-center m-0">&copy; <?= date('Y') ?> BUDOSPORT 80. Tous droits réservés.</p>
    </footer>


    <script src="public/assets/js/flash_message.js"></script>
    <script src="public/assets/js/form.js"></script>
</body>
</html>