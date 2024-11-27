<?php
session_start(); 
include('header.php');
include('navbar.php');
include('connect.php');
$sql= "SELECT * FROM hire_tbl";
$result= mysqli_query($con,$sql);
if(!$result){
    echo "no there's error";
}
$num=1;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overview Post</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- DataTables Responsive CSS -->
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" rel="stylesheet">
    
    <style>
      /* Custom styles for better mobile view */
      table img {
        max-width: 100%;
        height: auto;
      }
    </style>
    
  </head>
  <body class="bg-primary-subtle">
    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <p class="text-center text-danger-emphasis fs-4 fw-bolder">VIEW Applicants</p>
          
          <!-- Table Responsive Wrapper -->
          <div class="table-responsive">
            <table id="#postTable" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">S.no</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Skills</th>
                  <th scope="col">Image</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>

              <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <th scope="row"><?= $num; ?></th>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['phone']; ?></td>
                    <td><?= $row['skills']; ?></td>
                    <td><img src="upload_image/images/<?= $row['image']; ?>" alt="image" height="80px" width="80px"></td>
                    <td><td>
                <?php 
                    if ($row['status'] === 'not approved') { ?>
                        <!-- Red Approve button if not approved -->
                        <a href="method.php?id=<?= $row['id']; ?>" class="btn btn-danger">Pending</a>
                    <?php } else { ?>
                        <!-- Green Approved button if already approved -->
                        <button class="btn btn-success" >Approved</button>
                    <?php } ?>
                </td>
                  </tr>
                <?php $num++; } ?>
              </tbody>
            </table>
          </div> <!-- End of .table-responsive -->
        </div>
      </div>
    </div>
    
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    
    <!-- DataTables Responsive JS -->
    <!-- <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script> -->
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- DataTables Initialization with Responsive -->
    <script>
      $(document).ready(function() {
          $('#postTable').DataTable({
          });
      });
    </script>
    
  </body>
</html>
