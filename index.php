<?php
session_start();
require('./config/db_conn.php');

$login = $_SESSION['logedin'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';
$error = $_GET['error'] ?? ''; 
include('./inc/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href="#ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Regester</a>
                </li>
            </ul>
            <!-- Tabs navs -->
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <!-- Tabs content -->
            <div class="tab-content" id="ex2-content">
                <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <form action="./inc/login.php" method="POST">
                                    <label class="form-label mt-2" for="username">Username</label>
                                    <input class="form-control" name="username" id="username" type="text">
                                    <label class="form-label mt-2" for="password">Password</label>
                                    <input class="form-control" name="password" id="password" type="password">
                                    <button class="btn btn-primary mt-2" name="login" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                    <div class="container">
                        <div class="col-12">
                            <form action="./inc/regester.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-check mt-2" for="fname">First Name</label>
                                        <input class="form-control" id="fname" name="fname" type="text">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-check mt-2" for="lname">Last Name</label>
                                        <input class="form-control" id="lname" name="lname" type="text">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-check mt-2" for="username">User Name</label>
                                        <input class="form-control" id="username" name="username" type="text">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-check mt-2" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-check mt-2" for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option disabled selected>Select</option>
                                            <option value="mail">Mail</option>
                                            <option value="Femail">Femail</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-check mt-2" for="password">Password</label>
                                        <input class="form-control" id="password" name="password" type="password">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-check mt-2" for="cpassword">Confirm Password</label>
                                        <input class="form-control" id="cpassword" name="cpassword" type="password">
                                    </div>
                                </div>
                                <button type="submit" name="registration" class="btn btn-primary mt-3">Regester</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs content -->
        </div>
    </div>
</div>

<?php
?>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($error !== '') : ?>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: "<?php echo $error ?>",
        })
    <?php endif; ?>
</script>

<?php include('./inc/footer.php') ?>