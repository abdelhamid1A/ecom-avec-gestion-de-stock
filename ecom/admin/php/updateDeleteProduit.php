<?php
    include('menu.php');
    // if(isset($_GET["id"]) && !empty( $_GET['id'] )):
    
        $conn = new mysqli("localhost", "root", "", "shop");
        $id=$_GET["id"];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM `produit` where ID_PRD = $id";
        $result = mysqli_query($conn, $sql);
        // print_r($result);
        $row = mysqli_fetch_array($result);
// print_r($row);
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $qte = $_POST['qte'];
    $prix = $_POST['prix'];
    $nom = $_POST['nom'];
    $stmt = $conn->prepare("UPDATE produit SET qte=$qte WHERE ID_PRD = $id");
    $stmt->execute();
    header('Location: updateDeleteProduit.php?id='.$id);
exit();
}
?>
        
            <form action="updateDeleteProduit.php" method="POST">
                <img src="../../images/<?php echo $row['IMAGE']?>.jpg" alt="" style="width: 500px;height:300px;margin-bottom: 50px;"><br>
                <input type="text"  name="qte" value="<?php echo $row['qte']?>"><br>
                <input type="hidden" name="id" value="<?php echo $row['ID_PRD']?>"><br>
                <input type="text" name="prix" value="<?php echo $row['Prix']?>"><br>
                <input type="text" name="nom" value="<?php echo $row['NOM']?>"><br>
                <button type="submit" name="submit">modifier</button>


            
                </form>
            
 

            