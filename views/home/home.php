<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php if(isset($_SESSION['budosport']['user_disconnect'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("user_disconnect"); ?></p>
    </div>
<?php endif; ?>

<?php $view = ob_get_clean() ?>