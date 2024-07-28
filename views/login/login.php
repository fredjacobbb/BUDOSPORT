<?php ob_start() ?>

<ul>
    <li class="fs-6"><a href="/"><i class="fas fa-home me-3"></i>Accueil</a></li>
    <li class="fs-6"><a href="/?q=schedules"><i class="fas fa-clock me-3"></i>Les horaires</a></li>
    <li class="fs-6"><a href="./?q=disciplines"><i class="fas fa-user-ninja me-3"></i>Les disciplines</a></li>
    <li class="fs-6"><a href="./?q=login" class="active"><i class="fas fa-sign-in-alt me-3"></i>Se connecter</a></li>
    <li class="fs-6"><a href="./?q=registration"><i class="fas fa-user-plus me-3"></i>S'inscrire</a></li>
    <li class="fs-6"><a href="./?q=contact-us"><i class="fas fa-envelope me-3"></i>Nous contacter</a></li>
</ul>

<?php $nav = ob_get_clean() ?>

<?php ob_start() ?>

<form method="POST" class="bg-light mx-auto border border-2 rounded-2">

    <p class="fs-1 fw-semibold mb-5">Connexion</p>

    <label for="email" class="form-label">Email</label>
    <input type="email" placeholder="frdjacobbb@gmail.ze" class="form-control mb-2 fw-light" id="email">

    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" placeholder="fred" class="form-control mb-2 fw-light" id="firstname">

    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control fw-light" id="password">

    <a href="./?q=forgot-password" class="d-inline-block my-4 text-dark fw-light text-underline-dark">Mot de passe oublié ?</a>

    <div class="text-center m-4">
        <button class="btn btn-red text-light" type="submit">Se connecter</button>
    </div>

</form>


<?php $view = ob_get_clean() ?>