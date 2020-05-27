<?php
include('includes/header.php');
$IDvar = $_GET['id_product'];
$sqlquery = "SELECT * FROM `produit` WHERE ID_PRD =  '$IDvar'";
$Result = query($sqlquery);
// print_r($Result);
if (!$Result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$row = mysqli_fetch_assoc($Result);

if(isset($_POST['ID_PRD'])){
    $ID_PRD = $_POST['ID_PRD'];
    $NOM = $_POST['NOM'];
    $Quantity = $_POST['Quantity'];

    $sqlQuery = "SELECT * FROM produit where ID_PRD = '$ID_PRD'";
    $Result = query($sqlQuery);
    $products = mysqli_fetch_array($Result);
    // if (!$Result) {
    //     printf("Error: %s\n", mysqli_error($con));
    //     exit();
    // }
    print_r($products);
    $_SESSION['Product'.$ID_PRD] = array(
        'id' => $products['ID_PRD'], 
        'NOM' => $products['NOM'],
        'Prix' => $products['Prix'],
        'Quantity' => $Quantity,
        'Total' => $products['Prix']*$Quantity,
    );
    $_SESSION['cpt'] +=1;
    $_SESSION['Toto'] +=  $_SESSION['Product'.$ID_PRD]['Total'];

    redirect('checkouts.php');
}

?>

    <img src="images/<?php echo$row['IMAGE'] ?>.jpg" alt="" style="width: 200px; height:300px">
    <p><?php echo $row['NOM'] ?></p>
    <p><?php echo $row['Prix'] ?></p>
   
<form method="POST" >
Quantity:
<input type="number" name="Quantity" value=1>
<input type="hidden" name="ID_PRD" value="<?php echo $row['ID_PRD']?>">
<input type="hidden" name="NOM" value="<?php echo $row['NOM'] ?>">
<input type="submit" href="addtocart.php?id_product=<?php echo $row['ID_PRD']?>" value="add to carte">
</form>
