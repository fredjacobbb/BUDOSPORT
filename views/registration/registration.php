<?php ob_start() ?>

<?php use Leaf\Flash ?>

<?= Flash::display("connect_failed"); ?>

<form method="POST" class="bg-light m-4 mx-auto border border-2 rounded-2 pt-5 px-3" style="max-width:450px">

    <p class="fs-1 fw-semibold">Inscription</p>

    <div class="d-flex justify-content-around align-items-center my-4">
        <p class="fw-lighter m-0">Vous possédez un compte ? </p>
        <a href="./?q=login" class="text-danger fs-3 p-0 text-decoration-none fw-medium">Se connecter</a>
    </div>

    <label class="form-label mt-1" for="name">Nom</label>
    <input type="text" name="name" value="okok" class="form-control fw-light" id="name">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['name']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['name'] ?? '' ?></p>

    <label class="form-label mt-1" for="firstname">Prénom</label>
    <input type="text" name="firstname" value="okok" class="form-control fw-light" id="firstname">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['firstname'] ?? '' ?></p>

    <label class="form-label mt-1" for="email">Email</label>
    <input type="email" name="email" value="ok@ok.fr" class="form-control fw-light" id="email">
    
    <label class="form-label mt-1" for="password">Mot de passe</label>
    <input type="password" name="password" value="okokokokokk" class="form-control fw-light" id="password">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['password']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['password'] ?? '' ?></p>

    <label class="form-label mt-1" for="birthdate">Date de naissance</label>
    <input class="form-control fw-light" name="birthdate" value="2000-08-05" type="date">

    <label class="form-label mt-1" for="discipline">Discipline</label>
    <select name="discipline" class="form-select fw-light" id="discipline">
        <? foreach($disciplines as $discipline): ?>
            <option value="<?= $discipline->discipline_id ?>"><?= ucfirst($discipline->discipline_name) ?></option>
        <? endforeach ?>
    </select>
    <p class="fw-medium fs-6<?= !empty(Validator::$errors['discipline']) ? 'text-danger' : 'd-none' ?>"><?= Validator::$errors['discipline'] ?? '' ?></p>

    <label class="form-label mt-1" for="grade">Grades</label>
    <select name="grade" class="form-select fw-light" id="grade">
        <? foreach($grades as $grade): ?>
            <option value="<?= $grade->grade_id ?>"><?= ucfirst($grade->grade_name) ?></option>
        <? endforeach ?>
    </select>
    <p class="<?= !empty(Validator::$errors['grade']) ? 'text-danger' : 'd-none' ?>"><?= Validator::$errors['grade'] ?? '' ?></p>

    <div class="text-center m-4">
        <button class="btn btn-danger" type="submit">S'inscrire</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>