<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUDOSPORT</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="node_modules/fontawesome-free/css/all.min.css">
    <script src="node_modules/gsap/dist/all.js"></script>
    <script src="node_modules/typewriter-effect/dist/core.js"></script>
    <script type="module" src="node_modules/progressbar.js/dist/progressbar.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
</head>
<body class="bg-dark text-light">

    <header>
        <img class="img header-logo" src="public/assets/img/header_logo.webp" alt="brand_icon">
    </header>
    
    <nav class="sticky-top bg-dark">
        <ul>
            <li class="fs-6"><a class="active" href="/"><i class="fas fa-home me-3"></i>Accueil</a></li>
            <li class="fs-6"><a href="/?q=schedules"><i class="fas fa-clock me-3"></i>Nos horaires</a></li>
            <li class="fs-6"><a href="./?q=disciplines"><i class="fas fa-user-ninja me-3"></i>Nos disciplines</a></li>
            <li class="fs-6 <?= !empty($_SESSION['budosport']['userLogged']) ? 'd-none' : '' ?>"><a href="./?q=login"><i class="fas fa-sign-in-alt me-3"></i>Se connecter</a></li>
            <li class="fs-6 <?= !empty($_SESSION['budosport']['userLogged']) ? 'd-none' : '' ?>"><a href="./?q=registration"><i class="fas fa-user-plus me-3"></i>S'inscrire</a></li>
            <li class="fs-6 <?= !empty($_SESSION['budosport']['userLogged']) ? '' : 'd-none' ?> <?= !empty($_SESSION['budosport']['userLogged']) && $_SESSION['budosport']['userLogged'] == 'admin_connected' ? 'd-none' : '' ?>"><a href="./?q=mon-espace"><i class="fas fa-user-plus me-3"></i>Mon espace</a></li>
            <li class="fs-6 <?= !empty($_SESSION['budosport']['userLogged']) ? '' : 'd-none'?>"><a href="./?q=disconnect"><i class="fas fa-sign-in-alt me-3"></i>Se déconnecter</a></li>
            <li class="fs-6"><a href="./?q=contact-us"><i class="fas fa-envelope me-3"></i>Nous contacter</a></li>
        </ul>
    </nav>

    <?= $view ?>

    <footer class="container-fluid bg-red text-light pt-5 pb-2 mt-5">
        <div class="row align-items-center justify-content-center justify-content-md-between mx-sm-5 my-5">
            <div class="col-md-4 col-12 mb-4 text-center text-md-start">
                <p class="fs-2"><strong>BUDOSPORT 80</strong></p>
                <p>14 rue colbert 80480 AMIENS</p>
                <p><a href="tel:+0612121212" class="text-light text-decoration-none">Tél : 0612121212</a></p>
                <p><a href="mailto:budosport80@gmail.com" class="text-light text-decoration-none">budosport80@gmail.com</a></p>
            </div>
            <hr class="d-md-none text-light w-75 my-5">
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
   
    <script src="public/assets/js/FlashMessage.js"></script>
    <script src="public/assets/js/validator/form-validation.js"></script>
    <script type="module" src="public/assets/js/scrollEffect.js"></script>
    <script type="module" src="public/assets/js/TextAnimations.js"></script>
    <script type="module" src="public/assets/js/loadingbarEffects.js"></script>
    <script type="module" src="public/assets/js/formEffect.js"></script>
    <script type="module" src="public/assets/js/dashbHide.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/assets/js/map.js"></script>
    <script src="public/assets/js/techniques.js"></script>
</body>
</html>