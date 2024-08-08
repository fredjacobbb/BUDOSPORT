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
        <h3 class="fs-0 text-red m-0">Deux séances</h3>
        <p class="fs--1 text-red fw-bolder text-decoration-underline link-offset-3">OFFERTE</p>
    </div>
    <div class="block-bottom-banner col-10 col-md-5 text-center bg-red position-absolute bottom-0 p-4 py-2">
        <h4 class="text-light fw-lighter fs-6 m-0">Club dirigé par Frédéric Bourgouin 7e DAN</h4>
    </div>
</div>

<?php $view = ob_get_clean() ?>