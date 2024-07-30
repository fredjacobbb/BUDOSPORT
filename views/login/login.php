<?php use Leaf\Flash ?>
<?php use Leaf\Http\Session ?>

<?php ob_start() ?>

<form method="POST" class="bg-light mx-auto border border-2 rounded-2">

    <p class="fs-1 fw-semibold mb-5">Connexion</p>

    <label for="email" class="form-label">Email</label>
    <input name="email" type="email" placeholder="frdjacobbb@gmail.ze" class="form-control mb-2 fw-light" id="email">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['email']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['email'] ?? '' ?></p>

    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" name="firstname" placeholder="fred" class="form-control mb-2 fw-light" id="firstname">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['firstname'] ?? '' ?></p>

    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control fw-light" id="password">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>

    <a href="./?q=forgot-password" class="d-inline-block my-4 text-dark fw-light text-underline-dark">Mot de passe oublié ?</a>

    <div class="text-center m-4">
        <button class="btn btn-red text-light" type="submit">Se connecter</button>
    </div>

</form>


<?php $view = ob_get_clean() ?>