<?php ob_start() ?>


<h1>REGISTRATION</h1>

<form method="POST" style="max-width:300px">

    <label class="form-label" for="name">Nom</label>
    <input type="text" name="name" value="okok" class="form-control" id="name">

    <label class="form-label" for="firstname">Prénom</label>
    <input type="text" name="firstname" value="okok" class="form-control" id="firstname">

    <label class="form-label" for="email">Email</label>
    <input type="email" name="email" value="ok@ok.fr" class="form-control" id="email">
    
    <label class="form-label" for="password">Mot de passe</label>
    <input type="password" name="password" value="okokokokokk7//+A" class="form-control" id="password">

    <label class="form-label" for="birthdate">Date de naissance</label>
    <input class="form-control" name="birthdate" value="2000-08-05" type="date">

    <label class="form-label" for="discipline">Discipline</label>
    <select name="discipline" class="form-select" id="discipline">
        <? foreach($disciplines as $discipline): ?>
            <option value="<?= $discipline->discipline_id ?>"><?= ucfirst($discipline->discipline_name) ?></option>
        <? endforeach ?>
    </select>

    <label class="form-label" for="grade">Grades</label>
    <select name="grade" class="form-select" id="grade">
        <? foreach($grades as $grade): ?>
            <option value="<?= $grade->grade_id ?>"><?= ucfirst($grade->grade_name) ?></option>
        <? endforeach ?>
    </select>

    <div class="text-center m-4">
        <button class="btn btn-danger" type="submit">S'inscrire</button>
    </div>

</form>

<?php $view = ob_get_clean() ?>