<?php ob_start() ?>

<form method="POST" class="bg-light m-4 mx-auto border border-2 rounded-2 pt-5 px-3" style="max-width:450px">

    <p class="fs-1 fw-semibold mb-5">Connexion</p>

    <label for="email" class="form-label">Email</label>
    <input type="email" placeholder="frdjacobbb@gmail.ze" class="form-control mb-2 fw-light" id="email">

    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" placeholder="fred" class="form-control mb-2 fw-light" id="firstname">

    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control fw-light" id="password">

    <a href="" class="d-block my-4 text-dark fw-light text-underline-dark">Mot de passe oublié ?</a>

    <div class="text-center m-4">
        <button class="btn btn-danger" type="submit">Se connecter</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>