<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php $grade = ['blanche', 'jaune', 'orange', 'vert', 'bleu','marron','noir']; ?>

<?php if(!empty($_SESSION['budosport']['deletion_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("deletion_success"); ?></p>
    </div>
<?php endif; ?>
<?php if(!empty($_SESSION['budosport']['deletion_error'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("deletion_error"); ?></p>
    </div>
<?php endif; ?>

<ul class="list-unstyled d-flex justify-content-center flex-wrap mt-5">
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none active" href="?real=admin&action=dashboard-students">Dashboard Etudiants</a></li>
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none " href="?real=admin&action=dashboard-schedules">Dashboard Horaires</a></li>
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none " href="?real=admin&action=dashboard-techniques">Dashboard Techniques</a></li>
</ul>

<div class="overflow-x-scroll d-flex my-5" id="dashb">
    <?php foreach($students->ages as $student): ?>
        <div class="minw-100 dashb-slide">
            <div>
                <h2 class="text-light fs-1 bg-red ps-4 py-3"><?= $student->age_tranche ?> ans</h2>
            </div>
            <?php foreach($student->disciplines as $discipline): ?>
                <?php if (count($discipline->students) > 0): ?>
                    <table class="table table-dark p-5 w-75 mx-auto my-5">
                        <h3 class="text-light text-center px-3 fs-1 m-5"><?= ucfirst($discipline->discipline_name) ?></h3>
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ceinture</th>
                                <th scope="col">Profil</th>
                                <th scope="col">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach($discipline->students as $students): ?>
                                <tr>
                                    <td><?= ucfirst($students->student_name) ?></td>
                                    <td><?= ucfirst($students->student_firstname) ?></td>
                                    <td><?= $students->student_email ?></td>
                                    <td><?= $grade[$students->grade_id - 1] ?></td>
                                    <td>
                                        <a class="btn btn-secondary text-light" href="/?real=admin&action=student&student_token=<?= $students->student_token ?>">profil</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-red text-light" href="/?real=admin&action=delete&student_token=<?= $students->student_token ?>">supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>


<?php $view = ob_get_clean() ?>