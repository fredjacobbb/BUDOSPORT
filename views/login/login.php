<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php 
    "6LcZdT0qAAAAAEZwNPrfy_3pgkWYFHbaX0J80uTF public";
    "6LcZdT0qAAAAAPRUmCXVjBhtr2FjSslAyL1Fvj6p secret";
?>

<?php if(isset($_SESSION['budosport']['registration_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("registration_success"); ?></p>
        <hr>
        <a class="text-decoration-none text-light" href="mailto:">Ouvrez votre boite mail en cliquant ici</a>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['budosport']['success_mail_send'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("success_mail_send"); ?></p>
        <hr>
        <a class="text-decoration-none text-light" href="mailto:">Ouvrez votre boite mail en cliquant ici</a>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['budosport']['valid_email_checking'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("valid_email_checking"); ?></p>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['budosport']['change_password_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("change_password_success"); ?></p>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['budosport']['user_connect_error'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("user_connect_error"); ?></p>
    </div>
<?php endif; ?>

<form method="POST" class="form-login bg-light border border-2 rounded-2">

    <h2 class="fs-1 fw-semibold mb-5 text-dark">Connexion</h2>

    <label for="email" class="form-label text-dark">Email</label>
    <input name="email" type="email" class="form-control mb-2 fw-light" id="email" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['email']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['email'] ?? '' ?></p>
    
    <label for="firstname" class="form-label text-dark">Prénom</label>
    <input type="text" name="firstname" class="form-control mb-2 fw-light" id="firstname" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['firstname'] ?? '' ?></p>
    <div>
        <p class="fw-lighter error-message-firstname text-danger fs-6 my-2"></p>
    </div>

    <label for="password" class="form-label text-dark">Mot de passe</label>
    <input type="password" name="password" class="form-control fw-light" id="password" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>
    <div>
        <p class="fw-lighter error-message-password text-danger fs-6 my-2"></p>
    </div>
    
    <input type="hidden" name="submit_form">

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <a href="./?q=forgot-password" class="d-inline-block my-4 text-dark fw-light text-underline-dark">Mot de passe oublié ?</a>

    <div class="text-center m-4">
        <button class="btn btn-red text-light btn-registration g-recaptcha" data-sitekey="6LcZdT0qAAAAAEZwNPrfy_3pgkWYFHbaX0J80uTF" 
        data-callback='onSubmit' 
        data-action='submit'
        type="submit">Se connecter</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>