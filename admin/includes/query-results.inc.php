<?php
if (isset($_GET['message'])) {
?>
    <div class="alert alert-success" role="alert">
        <?php echo $_GET['message'] ?>
    </div>
<?php
} elseif (isset($_GET['delete'])) {
?>
    <div class="alert alert-success" role="alert">
        Successfully deleted!
    </div>
<?php
} elseif (isset($_GET['update'])) {
?>
    <div class="alert alert-success" role="alert">
        Successfully updated!
    </div>
<?php }
?>

<!-- put the code below under the wrapper container -->
<!-- include 'includes/query-results.inc.php'; -->