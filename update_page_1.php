<?php include('header.php'); ?>
<?php include_once('dbcon.php'); ?>

<?php
$row = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `students` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error());
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<?php
if (isset($_POST['update_students'])) {
    if (isset($_GET['id_new'])) {
        $idnew = $_GET['id_new'];
    }

    $fname = isset($_POST['f_name']) ? $_POST['f_name'] : '';
    $lname = isset($_POST['l_name']) ? $_POST['l_name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';

    $query = "UPDATE `students` SET `first_name` = '$fname', `last_name` = '$lname', `age` = '$age' WHERE `id` = '$idnew'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error());
    } else {
        header('location:index.php?update_msg=You have successfully updated the data.');
    }
}
?>

<form action="update_page_1.php?id_new=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" class="form-control" value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" class="form-control" value="<?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" value="<?php echo isset($row['age']) ? $row['age'] : ''; ?>">
    </div>
    <input type="submit" class="btn btn-success" name="update_students" value="Update">
</form>

<?php include('footer.php'); ?>
