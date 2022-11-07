<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Edit and Update Data</title>
</head>
<body>
    <?php
    require './PHP/functions.php';
    $connection = dbConnect();

    $id = $_POST['id'];

    $query = "SELECT * FROM `post` WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        while($row = mysqli_fetch_array($query_run))
        {
            ?>
   
                            <h2> PHP - CRUD : Update Data</h2>
                            <hr>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <div class="form-group">
                                    <label for=""> title </label>
                                    <input type="text" name="fname" class="form-control" value="<?php echo $row['title'] ?>" placeholder="Enter Title" required>
                                </div>
                                <div class="form-group">
                                    <label for=""> short </label>
                                    <input type="text" name="lname" class="form-control" value="<?php echo $row['short'] ?>" placeholder="Enter short" required>
                                </div>
                                <div class="form-group">
                                    <label for=""> content </label>
                                    <input type="text" name="contact" class="form-control" value="<?php echo $row['content'] ?>" placeholder="Enter Content" required>
                                </div>

                                <button type="submit" name="update" class="btn btn-primary"> Update Data </button>

                                <a href="main.php" class="btn btn-danger"> CANCEL </a>
                            </form>
                    
                    <?php
                    if(isset($_POST['update']))
                    {
                        $fname = $_POST['title'];
                        $lname = $_POST['short'];
                        $contact = $_POST['content'];

                        $query = "UPDATE student SET title='$title', short='$short', content=' $content' WHERE id='$id'  ";
                        $query_run = mysqli_query($connection, $query);

                        if($query_run)
                        {
                            echo '<script> alert("Data Updated"); </script>';
                            header("location:main.php");
                        }
                        else
                        {
                            echo '<script> alert("Data Not Updated"); </script>';
                        }
                    }
                    ?>

                </div>
            </div>
            <?php
        }
    }
    else
    {
        // echo '<script> alert("No Record Found"); </script>';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>No Record Found</h4>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</body>
</html>