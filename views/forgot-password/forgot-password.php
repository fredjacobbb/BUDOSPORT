<?php use Leaf\Flash; ?>

<?php ob_start() ?>

<?php if(isset($_SESSION['budosport']['change_password_error'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("change_password_error"); ?></p>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['budosport']['error_mail_send'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("error_mail_send"); ?></p>
        <hr>
        <a class="text-decoration-none text-light" href="mailto:">Ouvrez votre boite mail en cliquant ici</a>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['budosport']['change_password_error'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("change_password_error"); ?></p>
        <hr>
        <a class="text-decoration-none text-light" href="mailto:">Ouvrez votre boite mail en cliquant ici</a>
    </div>
<?php endif; ?>


<form method="POST" class="form-login text-dark bg-light border border-2 rounded-2">

    <h2 class="fs-1 fw-semibold mb-5">Saisir les champs</h2>

    <label for="email" class="form-label">Email</label>
    <input type="text" name="email" placeholder="frdjacobbb@gmail.ze" class="form-control mb-2 fw-light" id="email" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['email']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['email'] ?? '' ?></p>

    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" name="firstname" placeholder="fred" class="form-control mb-2 fw-light" id="firstname" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['firstname'] ?? '' ?></p>
    <div class="error-message-firstname text-danger fs-6 my-2"></div>


    <label for="lastname" class="form-label">Nom</label>
    <input type="text" name="name" class="form-control fw-light" id="lastname" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['name']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['name'] ?? '' ?></p>
    <div class="error-message-name text-danger fs-6 my-2"></div>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <div class="text-center m-4">
        <button class="btn btn-red text-light btn-registration g-recaptcha" data-sitekey="6LcZdT0qAAAAAEZwNPrfy_3pgkWYFHbaX0J80uTF" 
        data-callback='onSubmit' 
        data-action='submit'
        type="submit">Valider</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>