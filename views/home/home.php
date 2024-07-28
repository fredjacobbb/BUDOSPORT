<?php ob_start() ?>
<?php use Leaf\Flash ?>

<ul>
    <li class="fs-6"><a href="/" class="active"><i class="fas fa-home me-3"></i>Accueil</a></li>
    <li class="fs-6"><a href="/?q=schedules"><i class="fas fa-clock me-3"></i>Les horaires</a></li>
    <li class="fs-6"><a href="./?q=disciplines"><i class="fas fa-user-ninja me-3"></i>Les disciplines</a></li>
    <li class="fs-6"><a href="./?q=login"><i class="fas fa-sign-in-alt me-3"></i>Se connecter</a></li>
    <li class="fs-6"><a href="./?q=registration"><i class="fas fa-user-plus me-3"></i>S'inscrire</a></li>
    <li class="fs-6"><a href="./?q=contact-us"><i class="fas fa-envelope me-3"></i>Nous contacter</a></li>
</ul>

<?php $nav = ob_get_clean() ?>


<?php ob_start() ?>


<?php if(isset($_SESSION['leaf']['flash']['registration_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("registration_success"); ?></p>
    </div>
<?php endif; ?>


<?php $view = ob_get_clean() ?>