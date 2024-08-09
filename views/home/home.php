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
        <h3 class="fs-0 text-light m-0">Deux séances</h3>
        <p class="fs--1 text-light fw-bolder text-decoration-underline link-offset-3">OFFERTES</p>
    </div>
    <div class="block-bottom-banner col-10 col-md-5 text-start bg-red position-absolute bottom-0 p-4 py-2">
        <h4 class="text-light fw-lighter fs-6 m-0">Club dirigé par Frédéric Bourgouin 7e DAN</h4>
    </div>
</div>

<div class="section-presentation d-flex flex-wrap align-items-center align-content-center">
    <div class="section-presentation-first title-block d-flex align-items-center col-12 col-md-6">
        <h2 class="text-light title-section ps-5">LE SENSEI</h2>
    </div>
    <div class="section-presentation-second d-flex align-items-center col-12 col-md-6">
        <div class="text-center p-3">
            <img src="public/assets/img/pp-fred.png" alt="">
            <h2 class="text-light fs-2">Frédéric Bourgouin 7ème DAN ,</h2>
            <p class="text-light w-75 mx-auto fs-6">à commencé le judo, le ju-jitsu à l'âge de 5 ans et s'adonne depuis plus de 30 ans à partager sa passion pour le Ju-jitsu, le Judo et le Ne-waza.</p>
        </div>
    </div>
</div>

<div class="section-">

</div>

<?php $view = ob_get_clean() ?>