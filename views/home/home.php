<?php use Leaf\Flash ?>

<?php ob_start() ?>


<?php if(isset($_SESSION['leaf']['flash']['registration_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("registration_success"); ?></p>
    </div>
<?php endif; ?>


<?php $view = ob_get_clean() ?>