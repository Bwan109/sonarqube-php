<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM employer WHERE email = '$email'";
    $result = $db->query($sql);
    while ($row_pro = mysqli_fetch_array($result)) {
          $emp_id = $row_pro['id'];
          $emp_name = $row_pro['nameOfCompany'];
          $emp_about = $row_pro['aboutCompany'];
          $emp_email = $row_pro['email'];
          $emp_address1 = $row_pro['address1'];
          $emp_address2 = $row_pro['address2'];
          $emp_city = $row_pro['city'];
          $emp_state = $row_pro['state'];
          $emp_zipcode = $row_pro['zipcode'];
          $emp_phone = $row_pro['phone'];
          $emp_country = $row_pro['country'];
    }
?>

<?php 
  if(!isset($_SESSION['email'])){
      echo "<script>window.open('login.php','_self')</script>";
    }else{
?>
  <main>
    <h3 class="text-center p-3">This is the Internship Section</h3>
    <?php
      if(isset($_GET['delete'])){
        $id = sanitize($_GET['delete']);
        $db->query("UPDATE internships SET deleted = 1 WHERE id = '$id'");
        header('Location: internships.php');
      }

      if(isset($_GET['add']) || isset($_GET['edit'])){
        $parentQuery = $db->query("SELECT * FROM internships");
        $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):'');
        $postedOn = ((isset($_POST['postedOn']) && $_POST['postedOn'] != '')?sanitize($_POST['postedOn']):'');
        $applyBy = ((isset($_POST['applyBy']) && $_POST['applyBy'] != '')?sanitize($_POST['applyBy']):'');
        $nameOfCompany = ((isset($_POST['nameOfCompany']) && $_POST['nameOfCompany'] != '')?sanitize($_POST['nameOfCompany']):'');
        $aboutCompany = ((isset($_POST['aboutCompany']) && $_POST['aboutCompany'] != '')?sanitize($_POST['aboutCompany']):'');        
        $aboutInternship = ((isset($_POST['aboutInternship']) && $_POST['aboutInternship'] != '')?sanitize($_POST['aboutInternship']):'');
        $location = ((isset($_POST['location']) && $_POST['location'] != '')?sanitize($_POST['location']):'');    
        $perks = ((isset($_POST['perks']) && $_POST['perks'] != '')?sanitize($_POST['perks']):'');
        $duration = ((isset($_POST['duration']) && $_POST['duration'] != '')?sanitize($_POST['duration']):'');
        $stipend = ((isset($_POST['stipend']) && $_POST['stipend'] != '')?sanitize($_POST['stipend']):'');
        $positions = ((isset($_POST['positions']) && $_POST['positions'] != '')?sanitize($_POST['positions']):'');
        $whoCanApply = ((isset($_POST['whoCanApply']) && $_POST['whoCanApply'] != '')?sanitize($_POST['whoCanApply']):'');

        if(isset($_GET['edit'])){
          $edit_id = (int)$_GET['edit'];
          $internshipResults = $db->query("SELECT * FROM internships WHERE id = '$edit_id'");
          $internship = mysqli_fetch_assoc($internshipResults);
          $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$internship['category']);
          $postedOn = ((isset($_POST['postedOn']) && $_POST['postedOn'] != '')?sanitize($_POST['postedOn']):$internship['postedOn']);
          $applyBy = ((isset($_POST['applyBy']) && $_POST['applyBy'] != '')?sanitize($_POST['applyBy']):$internship['applyBy']);
          $nameOfCompany = ((isset($_POST['nameOfCompany']) && $_POST['nameOfCompany'] != '')?sanitize($_POST['nameOfCompany']):$internship['nameOfCompany']);
          $aboutCompany = ((isset($_POST['aboutCompany']) && $_POST['aboutCompany'] != '')?sanitize($_POST['aboutCompany']):$internship['aboutCompany']);          
          $aboutInternship = ((isset($_POST['aboutInternship']) && $_POST['aboutInternship'] != '')?sanitize($_POST['aboutInternship']):$internship['aboutInternship']);
          $location = ((isset($_POST['location']) && $_POST['location'] != '')?sanitize($_POST['location']):$internship['location']);
          $perks = ((isset($_POST['perks']) && $_POST['perks'] != '')?sanitize($_POST['perks']):$internship['perks']);
          $duration = ((isset($_POST['duration']) && $_POST['duration'] != '')?sanitize($_POST['duration']):$internship['duration']);
          $stipend = ((isset($_POST['stipend']) && $_POST['stipend'] != '')?sanitize($_POST['stipend']):$internship['stipend']);
          $positions = ((isset($_POST['positions']) && $_POST['positions'] != '')?sanitize($_POST['positions']):$internship['positions']);
          $whoCanApply = ((isset($_POST['whoCanApply']) && $_POST['whoCanApply'] != '')?sanitize($_POST['whoCanApply']):$internship['whoCanApply']);
        }

        if($_POST){
          $insertSql = "INSERT INTO internships (`category`,`emp_id`,`postedOn`,`applyBy`,`nameOfCompany`,`aboutCompany`,`aboutInternship`,`location`,`perks`,`duration`,`stipend`,`positions`,`whoCanApply`) VALUES ('$category','$emp_id','$postedOn','$applyBy','$nameOfCompany','$aboutCompany','$aboutInternship','$location','$perks','$duration','$stipend','$positions','$whoCanApply')";
            if(isset($_GET['edit'])){
              $insertSql = "UPDATE internships SET category = '$category',emp_id = '$emp_id', postedOn = '$postedOn', applyBy = '$applyBy', nameOfCompany = '$nameOfCompany', aboutCompany = '$aboutCompany', aboutInternship = '$aboutInternship', location = '$location', perks = '$perks', duration = '$duration', stipend = '$stipend', positions = '$positions', whoCanApply = '$whoCanApply' WHERE id = '$edit_id'";
            }
          $db->query($insertSql);
          echo "<script>window.open('internship.php','_self')</script>";

        }
    ?>
    <div class="container">
      <div class="">
        <div class="card">
          <div class="card-header card-title text-center">
            <h4 class="text-center"><?=((isset($_GET['edit']))?'EDIT':'ADD');?> INTERNSHIP DETAILS</h4>
          </div>
          <div class="card-body">
            <!-- Form -->
            <form  style="color: #757575;" action="internship.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data">

              <!-- Category -->
              <div class="form-group">
                <label for="category">Job name(Category)</label>
                <input type="text" id="category" name="category" class="form-control" value="<?=$category;?>" required>
              </div>
              <!-- Posted On -->
              <div class="form-group">
                <label for="postedOn">Posted On</label>
                <input type="date" id="postedOn" name="postedOn" class="form-control" value="<?=$postedOn;?>">
              </div>
              <!-- Apply By -->
              <div class="form-group">
                <label for="applyBy">Apply By</label>

                <input type="date" id="applyBy" name="applyBy" class="form-control" value="<?=$applyBy;?>" required>
              </div>
              <!-- Name of Company -->
              <div class="form-group">
                <label for="nameOfCompany">Name of Company</label>
                <input type="text" id="nameOfCompany" name="nameOfCompany" class="form-control" value="<?=$emp_name;?>" required>
              </div>
              <!-- About Company -->
              <div class="form-group">
                <label for="aboutCompany">About Company</label>
                <textarea id="aboutCompany" name="aboutCompany" class="md-textarea form-control" rows="3" required><?=$aboutCompany;?></textarea>
              </div>
              <!-- About Internship -->
              <div class="form-group">
                <label class="left" for="aboutInternship">About Internship</label>
                <textarea placeholder="About Internship" id="aboutInternship" name="aboutInternship" class="md-textarea form-control" rows="3"  required><?=$aboutInternship;?></textarea>

              </div>
              <!-- Location -->
              <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control" value="<?=$location;?>" required>
              </div>
              <!-- Perks of Internship -->
              <div class="form-group">
                <label for="perks">Perks of Internship</label>
                <input type="text" id="perks" name="perks" class="form-control" value="<?=$perks;?>" required>
              </div>
              <!-- Duration -->
              <div class="form-group">
                <label for="duration">Duration(Months)</label>

                <input type="number" id="duration" name="duration" class="form-control" value="<?=$duration;?>" required>
              </div>
              <!-- Stipend -->
              <div class="form-group">
                <label for="stipend">Salary</label>
                <input type="number" id="stipend" name="stipend" class="form-control" value="<?=$stipend;?>" required>
              </div>
              <!-- Price -->
              <div class="form-group">
                <label for="positions">No. of Positions Available</label>
                <input type="number" id="positions" name="positions" class="form-control" value="<?=$positions;?>" required>
              </div>
              <!--Material textarea-->
              <div class="form-groupm">
                <label for="whoCanApply">Who Can Apply</label>
                <textarea id="whoCanApply" name="whoCanApply" class="md-textarea form-control" rows="3" required><?=$whoCanApply;?></textarea>
              </div>

              <div class="card-footer">
                <button class="btn btn-black waves-effect z-depth-0" type="submit" name="add"><?=((isset($_GET['edit']))?'EDIT':'ADD');?> INTERNSHIPS</button>
              </div>
            </form>
          </div>      
        </div>
      </div>
      <?php } 
          else{
            $sql = "SELECT * FROM internships WHERE deleted = 0 AND emp_id = $emp_id";
            $presults = $db->query($sql);
          
      ?>
      <div class="container-fluid table-responsive">  
        <a href="internship.php?add=1" class="btn text-white" style="background-color: #1c2a48" id="add-product-btn">Add Internship</a>
        <div class="clearfix"></div><br>
        <table class="table table-striped table-bordered" style="display: table;">
          <thead>
            <th></th>
            <th></th>
            <th class="text-center"><h5 class="h5-responsive"><b>Job Name (Category)</b></h5></th>
            <th class="text-center"><h5 class="h5-responsive"><b>Location</b></h5></th>
            <th class="text-center"><h5 class="h5-responsive"><b>Duration</b></h5></th>
            <th class="text-center"><h5 class="h5-responsive"><b>Salary</b></h5></th>          
            <th class="text-center"><h5 class="h5-responsive"><b>Available Positions</b></h5></th>
            <th class="text-center"><h5 class="h5-responsive"><b>Posted On</b></h5></th>
            <th class="text-center"><h5 class="h5-responsive"><b>Apply By</b></h5></th>
          </thead>
          <tbody>
            <?php 
              $sql = "SELECT * FROM internships WHERE deleted = 0 AND emp_id = $emp_id";
              $internships = $db->query($sql);
            ?>

            <?php while($internship = mysqli_fetch_assoc($internships)):?>
              <tr>
                <td>
                  <a href="internship.php?edit=<?=$internship['id'];?>"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                  <a href="internship.php?delete=<?=$internship['id'];?>"><i class="fas fa-trash"></i></a>
                </td>
                <td class="text-center"><?=$internship['category'];?></td>
                <td class="text-center"><?=$internship['location'];?></td>
                <td class="text-center"><?=$internship['duration'];?></td>
                <td class="text-center"><?=$internship['stipend'];?></td>
                <td class="text-center"><?=$internship['positions'];?></td>
                <td class="text-center"><?=$internship['postedOn'];?></td>
                <td class="text-center"><?=$internship['applyBy'];?></td>
              </tr>
            <?php endwhile;?>
          </tbody>
        </table>
      </div>
    <?php } ?>
    </div>
  </main>

<?php include 'includes/footer.php'; } ?>