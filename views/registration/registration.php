<?php ob_start() ?>

<form method="POST" class="m-4 mx-auto" style="max-width:400px">

    <p class="fs-1 fw-bold">Inscription</p>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <p class="fw-light m-0">Vous possédez un compte ? </p>
        <a class="text-danger fs-2 me-5 p-0 text-decoration-none fw-medium">Se connecter</a>
    </div>

    <label class="form-label" for="name">Nom</label>
    <input type="text" name="name" value="okok" class="form-control fw-light" id="name">
    <p class="fw-light fs-6 mx-3 <?= !empty(Validator::$errors['name']) ? 'text-danger' : ''?>"><?= Validator::$errors['name'] ?? '' ?></p>

    <label class="form-label" for="firstname">Prénom</label>
    <input type="text" name="firstname" value="okok" class="form-control fw-light" id="firstname">
    <p class="fw-light fs-6 mx-3 <?= !empty(Validator::$errors['firstname']) ? 'text-danger' : ''?>"><?= Validator::$errors['firstname'] ?? '' ?></p>

    <label class="form-label" for="email">Email</label>
    <input type="email" name="email" value="ok@ok.fr" class="form-control fw-light" id="email">
    
    <label class="form-label" for="password">Mot de passe</label>
    <input type="password" name="password" value="okokokokokk" class="form-control fw-light" id="password">
    <p class="fw-light fs-6 mx-3 <?= !empty(Validator::$errors['password']) ? 'text-danger' : ''?>"><?= Validator::$errors['password'] ?? '' ?></p>

    <label class="form-label" for="birthdate">Date de naissance</label>
    <input class="form-control fw-light" name="birthdate" value="2000-08-05" type="date">

    <label class="form-label" for="discipline">Discipline</label>
    <select name="discipline" class="form-select fw-light" id="discipline">
        <? foreach($disciplines as $discipline): ?>
            <option class="fw-light" value="<?= $discipline->discipline_id ?>"><?= ucfirst($discipline->discipline_name) ?></option>
        <? endforeach ?>
    </select>
    <p class="fw-light fs-6<?= !empty(Validator::$errors['discipline']) ? 'text-danger' : '' ?>"><?= Validator::$errors['discipline'] ?? '' ?></p>

    <label class="form-label" for="grade">Grades</label>
    <select name="grade" class="form-select fw-light" id="grade">
        <? foreach($grades as $grade): ?>
            <option value="<?= $grade->grade_id ?>"><?= ucfirst($grade->grade_name) ?></option>
        <? endforeach ?>
    </select>
    <p class="<?= !empty(Validator::$errors['grade']) ? 'text-danger' : '' ?>"><?= Validator::$errors['grade'] ?? '' ?></p>

    <div class="text-center m-4">
        <button class="btn btn-danger" type="submit">S'inscrire</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>