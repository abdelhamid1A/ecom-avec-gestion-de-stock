<?php
include('includes/header.php');
$IDvar = $_GET['id'];
// print_r($IDvar);
$sqlquery = "SELECT * FROM `produit` WHERE ID_CAT =  '$IDvar'";
$Result = query($sqlquery);
// print_r($Result);
if (!$Result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
?>
<div class="container">
    <div class="row">
        <?php while($row = mysqli_fetch_assoc($Result)):?>
            <div class="col-lg-4">
            <img src="images/<?php echo$row['IMAGE'] ?>.jpg" alt="" style="width: 200px; height:300px">
            <p><?php echo$row['NOM'] ?></p>
            <p><?php echo$row['Prix'] ?></p>

            <button><a href="addtocart.php?id_product=<?php echo $row['ID_PRD']?>">Add TO CARTE</a></button>
            </div>
            <?php endwhile; ?>
     </div>
</div>

