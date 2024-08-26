<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php $user = $_SESSION['user_info'] ?? '' ?>


<?php if(!empty($_SESSION['budosport']['user_connect_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("user_connect_success"); ?></p>
    </div>
<?php endif; ?>

<div>
    <div class="d-flex align-items-center gap-5 my-5 justify-content-evenly flex-wrap">
        <div class="d-flex align-items-center flex-wrap justify-content-center shadow discipline-grade-block">
            <h2 class="text-center fs-0 first-letter-red w-100"><?= ucfirst($user->discipline->discipline_name) ?></h2>
            <p class="text-center p-3">
                <img class="w-50" src="public/assets/img/<?= strval($user->grade_name) ?>.png" alt="">
            </p>
        </div>
        <div id="pgBar" class="fs-1 fw-bold text-end" data-techniques="<?= $user->nbTechniques ?>" data-valid="<?= $user->validTechniques ?>" percentage-score="<?= intval(($user->validTechniques * 100) / $user->nbTechniques) ?>" data-value="20" data-preset="circle">
        </div>
    </div>
</div>

<div class="my-5">
    <h2 class="my-5">Liste techniques</h2>
    <div class="accordion accordion-flush w-75 mx-auto" id="accordionFlushExample">
        <div class="accordion-item bg-dark">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Validées <i class="fa fa-check text-success ms-3 fs-3"></i>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse text-light" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <?php foreach($user->categories as $key_category => $category): ?>
                        <div class="col-12 card-category shadow my-3 bg-dark">
                            <p class="fs-2 p-3 title"><?= ucfirst($category->technique_category) ?></p>
                            <?php foreach($category->techniques as $technique): ?>
                                <?php if ($technique->valid): ?>
                                    <p class="fs-4 m-3 p-0 here"><?= ucfirst($technique->technique_name) ?> <b class="fw-light fs-6">( le <?= $technique->valid[0][0] ?> )</b></p>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="accordion-item bg-dark">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Non-validées 
                <svg xmlns="http://www.w3.org/2000/svg" class="ms-3" height="30" width="30" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#de1212" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>    </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body text-light">
                    <?php foreach($user->categories as $key_category => $category): ?>
                        <div class="col-12 card-category shadow my-3">
                            <p class="fs-2 p-3 title"><?= ucfirst($category->technique_category) ?></p>
                            <?php foreach($category->techniques as $technique): ?>
                                <?php if (!$technique->valid): ?>
                                    <p class="fs-4 m-3 p-0 here"><?= ucfirst($technique->technique_name) ?></p>            
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view = ob_get_clean() ?>