<?php
require('../config/db_conn.php');
$edit_id = $_GET['edit'];
$query = "SELECT * FROM `todos` WHERE `id` = '$edit_id'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$todo = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'edit_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!empty($task)) {
        $query = "UPDATE `todos` SET `task`='$task' WHERE `id` = '$id'";
        echo $query;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        header('location: ../todos.php');
    } else {
        $error = "Please fill task Field.";
        header("location: ./edit.php?edit=$edit_id");
    }
}

$error = $_GET['error'] ?? '';
include('./header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="./edit.php" method="post">
                <label class="form-label mt-2" for="task">Task</label>
                <textarea class="form-control" name="task" id="task" cols="30" rows="5"><?php echo $todo[0]['task'] ?></textarea>
                <input type="hidden" name="edit_id" value="<?php echo $edit_id ?>">
                <button class="btn btn-primary mt-2" name="update" type="submit">Update</button>
            </form>
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
<?php include('./footer.php') ?>