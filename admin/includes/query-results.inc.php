<?php
if (isset($_GET['message'])) {
?>
    <div class="alert alert-success" role="alert">
        <?php echo $_GET['message'] ?>
    </div>
<?php } elseif (isset($_GET['delete'])) {
?>
    <div class="alert alert-success" role="alert">
        Successfully deleted!
    </div>
<?php
} ?>