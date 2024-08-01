<!DOCTYPE html>
<html lang="fr">
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
        <ul>
            <li class="fs-6"><a href="/"><i class="fas fa-home me-3"></i>Accueil</a></li>
            <li class="fs-6"><a href="/?q=schedules"><i class="fas fa-clock me-3"></i>Les horaires</a></li>
            <li class="fs-6"><a href="./?q=disciplines"><i class="fas fa-user-ninja me-3"></i>Les disciplines</a></li>
            <li class="fs-6"><a href="./?q=login"><i class="fas fa-sign-in-alt me-3"></i>Se connecter</a></li>
            <li class="fs-6"><a href="./?q=registration"><i class="fas fa-user-plus me-3"></i>S'inscrire</a></li>
            <li class="fs-6"><a href="./?q=contact-us"><i class="fas fa-envelope me-3"></i>Nous contacter</a></li>
        </ul>
    </nav>

    <?= $view ?>

    <footer class="container-fluid bg-red text-light pt-5 pb-2 mt-5">
        <div class="row align-items-center justify-content-center justify-content-sm-around">
            <div class="col-md-4 col-12 mb-4 text-center">
                <p class="fs-2"><strong>BUDOSPORT 80</strong></p>
                <p>14 rue colbert 80480 AMIENS</p>
                <p><a href="tel:+0612121212" class="text-light text-decoration-none">Tél : 0612121212</a></p>
                <p><a href="mailto:budosport80@gmail.com" class="text-light text-decoration-none">budosport80@gmail.com</a></p>
            </div>
            <hr class="d-md-none text-light w-75">
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


    <script src="public/assets/js/form.js"></script>
    <script src="public/assets/js/flash_message.js"></script>
</body>
</html>