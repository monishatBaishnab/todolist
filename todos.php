<?php
session_start();
require('./config/db_conn.php');

$login = $_SESSION['logedin'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';

if (true !== $login) {
    header('location: index.php');
}

$query = "SELECT * FROM `profile` WHERE `user_id` = '$user_id'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$profile = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fname = ucfirst($profile[0]['first_name']);
$lname = ucfirst($profile[0]['last_name']);

$error = $_GET['error'] ?? '';
include('./inc/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex align-items-center justify-content-between py-3 border-bottom">
            <div>
                <h4 class="mb-0"><?php echo $fname." ".$lname ?></h4>
                <span><?php echo $profile[0]['email'] ?></span>
            </div>
            <div>
                <a href="./inc/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="./inc/add_todo.php" method="post">
                <label class="form-label mt-2" for="task">Task</label>
                <textarea class="form-control" name="task" id="task" cols="30" rows="5"></textarea>
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <button class="btn btn-primary mt-2" name="add_task" type="submit">Add</button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <table class="table table-striped">
                <tr>
                    <th>UserID</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
                <?php
                $query = "SELECT * FROM `todos` WHERE `user_id` = '$user_id'";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($todos as $todo) :
                ?>
                    <tr>
                        <td><?php echo $todo['user_id'] ?></td>
                        <td><?php echo $todo['task'] ?></td>
                        <td style="min-width: 216px;"><a href="./inc/edit.php?edit=<?php echo $todo['id'] ?>" class="btn btn-success">Edit</a><a class="btn btn-danger ms-2" href="./inc//delete.php?delete=<?php echo $todo['id']?>">Delete</a></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</div>

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