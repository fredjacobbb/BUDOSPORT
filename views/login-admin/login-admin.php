<?php use Leaf\Flash ?>

<?php ob_start() ?>

<form method="POST" class="form-login bg-light border border-2 rounded-2">

    <h2 class="fs-1 fw-semibold mb-5 text-dark">Connexion</h2>

    <label for="pseudo" class="form-label text-dark">Pseudo</label>
    <input name="admin_name" type="text" class="form-control mb-2 fw-light" id="pseudo" required>

    <label for="password" class="form-label text-dark">Mot de passe</label>
    <input type="password" name="admin_password" class="form-control fw-light" id="password" required>

    <div>
        <p class="fw-lighter error-message-password text-danger fs-6 my-2"></p>
    </div>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <div class="text-center m-4">
        <button class="btn btn-red text-light" type="submit">Se connecter</button>
    </div>

</form>


<?php $view = ob_get_clean() ?>

<?php // value="charlesbaudelaire" password ! new = "A   ZE,fo,ovvv,vaz,v,vza,vo888777415% voaz,v/////vavVVCx" ?>