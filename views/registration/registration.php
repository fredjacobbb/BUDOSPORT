<?php use Leaf\Flash ?>

<?php ob_start() ?>

<ul>
    <li class="fs-6"><a href="/"><i class="fas fa-home me-3"></i>Accueil</a></li>
    <li class="fs-6"><a href="/?q=schedules"><i class="fas fa-clock me-3"></i>Les horaires</a></li>
    <li class="fs-6"><a href="./?q=disciplines"><i class="fas fa-user-ninja me-3"></i>Les disciplines</a></li>
    <li class="fs-6"><a href="./?q=login"><i class="fas fa-sign-in-alt me-3"></i>Se connecter</a></li>
    <li class="fs-6"><a class="active" href="./?q=registration"><i class="fas fa-user-plus me-3"></i>S'inscrire</a></li>
    <li class="fs-6"><a href="./?q=contact-us"><i class="fas fa-envelope me-3"></i>Nous contacter</a></li>
</ul>

<?php $nav = ob_get_clean() ?>

<?php ob_start() ?>

<?php if(!empty($_SESSION['budosport']['registration_failed'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("registration_failed"); ?></p>
        <hr>
        <a class="text-decoration-none text-light" href="mailto:">Ouvrez votre boite mail en cliquant ici</a>
    </div>
<?php endif; ?>

<form method="POST" class="form-login bg-light mx-auto border border-2 rounded-2 text-dark">

    <h2 class="fs-1 fw-semibold">Inscription</h2>

    <div class="d-flex justify-content-around flex-wrap flex-sm-nowrap align-items-center my-4">
        <p class="fw-lighter fs-6 m-0">Vous possédez un compte ? </p>
        <a href="./?q=login" class="text-red fs-3 p-3 text-decoration-none fw-medium p-sm-0">Se connecter</a>
    </div>

    <label class="form-label mt-1" for="name">Nom</label>
    <input type="text" name="name" value="okok" class="form-control fw-light" id="name" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['name']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['name'] ?? '' ?></p>
    <div>
        <p class="fw-lighter link-offset-2 link-underline link-underline-opacity-50 error-message-name text-danger fs-6 my-2"></p>
    </div>

    <label class="form-label mt-1" for="firstname">Prénom</label>
    <input type="text" name="firstname" value="okok" class="form-control fw-light" id="firstname" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['firstname'] ?? '' ?></p>
    <div class="error-message-firstname text-danger fs-6 my-2"></div>

    <label class="form-label mt-1" for="email">Email</label>
    <input type="email" name="email" value="ok@ok.fr" class="form-control fw-light" id="email" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['email']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['email'] ?? '' ?></p>

    <label class="form-label mt-1" for="password">Mot de passe</label>
    <input type="password" name="password" value="Azerty789////" class="form-control fw-light" id="password" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password-retyped']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password-retyped'] ?? '' ?></p>
    <div class="error-message-password text-danger fs-6 my-2"></div>
    <div class="info-password d-none"></div>


    <label class="form-label mt-1" for="password">Re-mot de passe</label>
    <input type="password" name="password-retyped" value="Azerty789////" class="form-control fw-light" id="password" required>

    <label class="form-label mt-1" for="birthdate">Date de naissance</label>
    <input class="form-control fw-light" name="birthdate" value="2000-08-05" type="date" required>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['birthdate']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['birthdate'] ?? '' ?></p>


    <label class="form-label mt-1" for="discipline">Discipline</label>
    <select name="discipline" class="form-select fw-light" id="discipline" required>
        <? foreach($disciplines as $discipline): ?>
            <option value="<?= $discipline->discipline_id ?>"><?= ucfirst($discipline->discipline_name) ?></option>
        <? endforeach ?>
    </select>
    <p class="fw-medium fs-6 <?= !empty(Validator::$errors['discipline']) ? 'text-danger' : 'd-none' ?>"><?= Validator::$errors['discipline'] ?? '' ?></p>

    <label class="form-label mt-1" for="grade">Grades</label>
    <select name="grade" class="form-select fw-light" id="grade">
        <? foreach($grades as $grade): ?>
            <option value="<?= $grade->grade_id ?>"><?= ucfirst($grade->grade_name) ?></option>
        <? endforeach ?>
    </select>
    <p class="<?= !empty(Validator::$errors['grade']) ? 'text-danger' : 'd-none' ?>"><?= Validator::$errors['grade'] ?? '' ?></p>

    <div class="text-center m-4">
        <button class="btn btn-red text-light btn-registration" type="submit">S'inscrire</button>
    </div>

</form>


<?php $view = ob_get_clean() ?>