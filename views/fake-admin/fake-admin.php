<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<form method="POST" class="form-login bg-light mx-auto border border-2 rounded-2">

    <h2 class="fs-1 fw-semibold mb-5 text-dark">Admin</h2>

    <label for="pseudo" class="form-label text-dark">Pseudo</label>
    <input name="pseudo" type="text" placeholder="admin" class="form-control mb-2 fw-light" id="pseudo" value="admin879" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['pseudo']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['pseudo'] ?? '' ?></p>

    <label for="password" class="form-label text-dark">Mot de passe</label>
    <input type="password" name="password" value="" class="form-control fw-light" id="password" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>
    <div>
        <p class="fw-lighter error-message-password text-danger fs-6 my-2"></p>
    </div>

    <div class="text-center m-4">
        <button class="btn btn-red text-light btn-registration" type="submit">Se connecter</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>

