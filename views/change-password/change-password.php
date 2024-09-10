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

<form method="POST" class="form-login text-dark bg-light border border-2 rounded-2">

    <h2 class="fs-1 fw-semibold mb-5">Nouveau mot de passe</h2>

    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control fw-light" id="password" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>
    <div class="error-message-password fw-lighter text-danger fs-6 my-2"></div>


    <label for="password" class="form-label">Nouvelle saisie</label>
    <input type="password" name="password-retyped" class="form-control fw-light" id="password" required>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <div class="h-captcha" data-sitekey="5ce43692-6ab6-4b4c-b9ce-78a817b2ada2"></div>

    <div class="text-center m-4">
        <button class="btn btn-red text-light btn-registration g-recaptcha" data-sitekey="6LcZdT0qAAAAAEZwNPrfy_3pgkWYFHbaX0J80uTF" 
        data-callback='onSubmit' 
        data-action='submit'
        type="submit">Valider</button>
    </div>

</form>


<?php $view = ob_get_clean() ?>