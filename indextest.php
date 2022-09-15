<?php 
  session_start();
  require_once 'core/init.php';
  include 'includes/header.php'; 
?>

<?php 
  if(isset($_POST['search'])){
    $searchKey = $_POST['search'];
    $sql = "SELECT * FROM internships WHERE category Like '%$searchKey%'";
    
  }else{
    $sql = "SELECT * FROM internships WHERE deleted=0";
    $searchKey = "";

  }
  $internships = $db->query($sql);

?>

<main>

    <h3 class="text-center p-3">List of Internships</h3>
    <form action="" method="POST">
        <div style="margin:auto" class="col-md-6">
            <input type="text" name="search" class='form-control' placeholder="Search By Job category" value="<?php echo $searchKey; ?>">
        </div>
        <div style="display:flex;  justify-content: center;" class="text-left">
            <button class="btn" >Search</button>
        </div>
    </form>
    <br><br>
    <div class="container-fluid row">
        <!-- List of Internships -->

        <?php while($internship = mysqli_fetch_assoc($internships)): ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="p-2 text-center card-title">
                        <?=$internship['nameOfCompany'];?>
                    </h2>
                </div>
                <div class="card-body">
                    <h4 class="p-2 h4-responsive float-left">
                        <?=$internship['category'];?>
                    </h4>
                    <h5 class="p-2 h5-responsive float-right"><b>Location: </b>
                        <?=$internship['location'];?>
                    </h5>
                    <table class="table table-bordered">
                        <thead>
                            <th>Duration</th>
                            <th>Salary</th>
                            <th>Posted On</th>
                            <th>Apply By</th>
                            <th>Available Positions</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?=$internship['duration'];?> months
                                </td>
                                <td>RM
                                    <?=$internship['stipend'];?>
                                </td>
                                <td>
                                    <?=$internship['postedOn'];?>
                                </td>
                                <td>
                                    <?=$internship['applyBy'];?>
                                </td>
                                <td>
                                    <?=$internship['positions'];?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="internship.php?internship=<?=$internship['id'];?>"
                        class="btn btn-success btn-black waves-effect z-depth-0">View Details</a>
                </div>
            </div>
        </div>
        <?php endwhile;?>
    </div>
    <br>
</main>









<?php include 'includes/footer.php'; ?>