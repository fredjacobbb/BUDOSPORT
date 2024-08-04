<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php if(isset($_SESSION['budosport']['success_change_password'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("success_change_password"); ?></p>
        <hr>
        <a class="text-decoration-none text-light" href="mailto:">Ouvrez votre boite mail en cliquant ici</a>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['budosport']['error_change_password'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("error_change_password"); ?></p>
    </div>
<?php endif; ?>

<form method="POST" class="bg-light mx-auto border border-2 rounded-2">

    <p class="fs-1 fw-semibold mb-5">Nouveau mot de passe</p>

    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control fw-light" id="password">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>

    <label for="password" class="form-label">Nouvelle saisie</label>
    <input type="password" name="password-retyped" class="form-control fw-light" id="password">

    <div class="text-center m-4">
        <button class="btn btn-red text-light" type="submit">Valider</button>
    </div>

</form>


<?php $view = ob_get_clean() ?>