<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php if(isset($_SESSION['budosport']['user_disconnect'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("user_disconnect"); ?></p>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['budosport']['error_email_checking'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("error_email_checking"); ?></p>
    </div>
<?php endif; ?>

<div class="position-relative row align-items-center w-100 m-0 p-0 banner-budo">
    <div class="banner-budo-home-bg">
    </div>
    <div class="top-50 position-absolute offer-description text-center">
        <div class="d-flex justify-content-center align-items-center">
            <b class="fs-0 text-red mx-3">Deux</b>
            <h3 class="fs-0 text-light m-0">séances</h3>
        </div>
        <p class="fs--1 text-light fw-bolder text-decoration-underline link-offset-3">OFFERTES</p>
    </div>
</div>

<div class="section-for-subscriber-home justify-content-center d-flex flex-wrap py-5 px-2">
    <p class="text-light text-animation text-center fs-4 fw-light"></p>
    <div class="mx-auto my-3 w-100 text-center">
        <button class="btn btn-light fw-bolder text-red">Nous rejoindre</button>
    </div>
</div>

<div class="section-presentation d-flex flex-wrap align-items-center align-content-center">
    <div class="container-one title-block d-flex align-items-center col-12 col-md-6">
        <h2 class="text-light title-section ps-3 w-100 py-5">UN MAÎTRE</h2>
    </div>
    <div class="container-two d-flex align-items-center justify-content-center mx-auto col-12 col-md-4">
        <div class="text-center p-5 shadow shadow rounded">
            <div class="container-sensei">
                <img src="public/assets/img/pp-fred.png" alt="">
            </div>
            <h2 class="text-light fs-3">Frédéric Bourgouin</h2>
            <p class="text-light p-2 mx-auto">7ème DAN, à commencé le judo, le ju-jitsu à l'âge de 5 ans et s'adonne depuis plus de 30 ans à partager sa passion pour le Ju-jitsu, le Judo et le Ne-waza.</p>
        </div>
    </div>
</div>

<div class="section-place d-flex flex-wrap-reverse justify-content-between align-items-center my-5">
    <div class="container-one col-12 col-md-6 me-3">
        <div id="map" class="shadow">
            <iframe width="100%" height="300px" frameborder="0" allowfullscreen allow="geolocation" src="//umap.openstreetmap.fr/fr/map/carte-sans-nom_1106076?scaleControl=false&miniMap=false&scrollWheelZoom=true&zoomControl=true&editMode=disabled&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=null&onLoadPanel=none&captionBar=false&captionMenus=true&captionControl=null"></iframe></p>
        </div>
    </div>
    <div class="container-two col-12 col-md-5">
        <div class="title-block-2">
            <h2 class="text-light title-section-2 bg-red ps-5 py-5 text-center">UN LIEU</h2>
        </div>
    </div>
</div>

<?php $view = ob_get_clean() ?>