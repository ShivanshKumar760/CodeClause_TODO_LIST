<?php if(isset($_SESSION['success'])){ ?>
<div class="alert alert-success">
  <a href="#" class="close" title="success-close">×</a>
  <strong>Success!</strong> <?php echo $_SESSION['success'] ?>
</div>
<?php unset($_SESSION['success']); } ?>

<?php if(isset($_SESSION['error'])){ ?>
<div class="alert alert-danger">
  <a href="#" class="close" title="error-close">×</a>
  <strong>Error!</strong> <?php echo $_SESSION['error'] ?>
</div>
<?php unset($_SESSION['error']); } ?>