<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php if(isset($_SESSION['budosport']['user_disconnect'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("user_disconnect"); ?></p>
    </div>
<?php endif; ?>

<div class="position-relative row align-items-center w-100 m-0 p-0 banner-budo">
    <div class="banner-budo-home-bg">
    </div>
    <div class="top-50 position-absolute offer-description text-center">
        <div class="d-flex justify-content-center align-items-center">
            <b class="fs-0 text-red m-3">Deux</b>
            <h3 class="fs-0 text-light m-0">séances</h3>
        </div>
        <p class="fs--1 text-light fw-bolder text-decoration-underline link-offset-3">OFFERTES</p>
    </div>
</div>

<div class="section-for-subscriber-home justify-content-center d-flex flex-wrap align-content-center align-items-center">
    <p class="text-light p-4 text-animation fs-2 fw-light"></p>
    <div class="mx-auto w-100 text-center">
        <button class="btn btn-light fw-bolder fs-5 text-red">Nous rejoindre</button>
    </div>
</div>

<!-- <div class="section-disciplines">
    <div class="d-flex justify-content-center align-content-center align-items-center my-5">
        <h2 class="text-red"><?= count($disciplines) ?></h2>
        <b class="text-light fs-0"> DISCIPLINES </b>
    </div>
    <div class="d-flex flex-wrap justify-content-start justify-content-center align-content-center mb-5 h-100">
        <?php foreach($disciplines as $key => $d): ?>
            <div class="discipline-card d-none card-<?= $key ?>">
                <p class="w-100 h-100 fs-1 fw-bold"><?= ucfirst($d->discipline_name) ?></p>
            </div>
        <?php endforeach ?>
    </div>
</div> -->

<div class="section-presentation d-flex flex-wrap align-items-center align-content-center">
    <div class="container-one title-block d-flex align-items-center col-12 col-md-6">
        <h2 class="text-light title-section ps-5 py-3">UN MAÎTRE</h2>
    </div>
    <div class="container-two d-flex align-items-center justify-content-center mx-auto col-12 col-md-6">
        <div class="text-center p-3">
            <div class="container-sensei">
                <img src="public/assets/img/pp-fred.png" alt="">
            </div>
            <h2 class="text-light fs-3">Frédéric Bourgouin</h2>
            <p class="text-light p-2 mx-auto">7ème DAN, à commencé le judo, le ju-jitsu à l'âge de 5 ans et s'adonne depuis plus de 30 ans à partager sa passion pour le Ju-jitsu, le Judo et le Ne-waza.</p>
        </div>
    </div>
</div>

<div class="section-">

</div>

<?php $view = ob_get_clean() ?>