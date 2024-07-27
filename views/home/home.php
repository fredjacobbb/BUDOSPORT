<?php ob_start() ?>

<ul>
    <li><a class="fs-5" href="/">Accueil</a></li>
    <li><a class="fs-5" href="/?q=schedules">Les horaires</a></li>
    <li><a class="fs-5" href="./?q=disciplines">Les disciplines</a></li>
    <li><a class="fs-5" href="./?q=login">Se connecter</a></li>
    <li><a class="fs-5 active" href="./?q=registration">S'inscrire</a></li>
    <li><a class="fs-5" href="./?q=contact-us"></a></li>
</ul>

<?php $nav = ob_get_clean() ?>


<?php ob_start() ?>

<h1>HOME</h1>

<?php $view = ob_get_clean() ?>