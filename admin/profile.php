<?php include "includes/admin_header.php" ?>
<?php
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_profile_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }
?>
<?php 
    if(isset($_POST['edit_user'])) {
        // $user_id = $_POST['user_id'];
        $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
        $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
        $user_role = $_POST['user_role'];
        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];

        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        // $post_date = date('d-m-y');


        // move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE username = '{$username}' ";

        $edit_user_query = mysqli_query($connection, $query);

        confirmQuery($edit_user_query);

    }
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome 
                            <small>Author</small>
                            
                        </h1>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_tags">Firstname</label>
                                <input class="form-control" value="<?php echo $user_firstname; ?>" type="text" name="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="post_status">Lastname</label>
                                <input class="form-control" value="<?php echo $user_lastname; ?>" type="text" name="user_lastname">
                            </div>
                            <div class="form-group">
                                <select name="user_role" id="">
                                <?php 
                                    if ($user_role == 'admin') {
                                        echo "<option value='subscriber'>Subscriber</option>";
                                        echo "<option value='admin' selected='selected'>Admin</option>";
                                    } else if ($user_role == 'subscriber') {
                                        echo "<option value='subscriber' selected='selected'>Subscriber</option>";
                                        echo "<option value='admin'>Admin</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="post_image">Post Image</label>
                                <input type="file" name="image">
                            </div> -->
                            <div class="form-group">
                                <label for="post_tags">Username</label>
                                <input class="form-control" value="<?php echo $username; ?>" type="text" name="username">
                            </div>
                            <div class="form-group">
                                <label for="post_content">Email</label>
                                <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="post_content">Password</label>
                                <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>
