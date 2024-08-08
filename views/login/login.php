<?php use Leaf\Flash ?>

<?php ob_start() ?>

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

<form method="POST" class="form-login bg-light mx-auto border border-2 rounded-2">

    <h2 class="fs-1 fw-semibold mb-5">Connexion</h2>

    <label for="email" class="form-label">Email</label>
    <input name="email" type="email" placeholder="frdjacobbb@gmail.ze" class="form-control mb-2 fw-light" id="email" value="ok@ok.fr" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['email']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['email'] ?? '' ?></p>
    
    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" name="firstname" placeholder="fred" value="okok" class="form-control mb-2 fw-light" id="firstname" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['firstname'] ?? '' ?></p>
    <div>
        <p class="fw-lighter error-message-firstname text-danger fs-6 my-2"></p>
    </div>

    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" value="aozfjjafFAZ//!!CA888" class="form-control fw-light" id="password" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>
    <div>
        <p class="fw-lighter error-message-password text-danger fs-6 my-2"></p>
    </div>

    <a href="./?q=forgot-password" class="d-inline-block my-4 text-dark fw-light text-underline-dark">Mot de passe oublié ?</a>

    <div class="text-center m-4">
        <button class="btn btn-red text-light btn-registration" type="submit">Se connecter</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>