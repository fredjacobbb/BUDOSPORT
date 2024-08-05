<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php $user = $_SESSION['user_info'] ?? '' ?>

<?php if(!empty($_SESSION['budosport']['user_connect_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("user_connect_success"); ?></p>
    </div>
<?php endif; ?>


<h1 class="fs-1"><?= ucfirst($user->student_firstname) ?></h1>

#//HhaujmJdwsI6rV4cdOFB5JG5VxoWFHnIxg2//

<p class="text-light"><?= $user->grade_name ?> belt</p>

<?php $view = ob_get_clean() ?>