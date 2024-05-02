<?php
  require_once("layout/header.php");
?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?php echo $adminObj->getAdminRowData($_SESSION["admin_id"])['AdminUsername']; ?>,</h3>
                  <h6 class="font-weight-normal mb-0">Here are the overview data of <span class="text-primary">F.O.O.D.S</span>!</h6>
                </div>
              </div>
            </div>
            <h1 class="text-center">Tables Overview Under Construction</h1>
          </div>
        </div>
        <!-- content-wrapper ends -->
<?php
  require_once("layout/footer.php");
?>