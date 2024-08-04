<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php $user = $_SESSION['user_info'] ?? '' ?>

<?php if(!empty($_SESSION['budosport']['user_connect_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("user_connect_success"); ?></p>
    </div>
<?php endif; ?>


<h1 class="fs-1">Bienvenue sur ton espace, <?= $user->student_firstname ?></h1>

<?php $view = ob_get_clean() ?>