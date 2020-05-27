<?php
    include('menu.php');
    // if(isset($_GET["id"]) && !empty( $_GET['id'] )):
    
        $conn = new mysqli("localhost", "root", "", "shop");
        $id=$_GET["id"];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM `produit` where ID_PRD=".$id;
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0){
while($rows = mysqli_fetch_array($result)) :?> 
             
             '<form method="POST" action="" enctype="multipart/form-data"><div class="divstandard">
                 <!-- <script language="JavaScript">
                 function showPreview(ele)
                 {
                     $("#imgAvatar").attr("src", ele.value); // for IE
                             if (ele.files && ele.files[0]) {
                     
                                 var reader = new FileReader();
                         
                                 reader.onload = function (e) {
                                     $("#imgAvatar").attr("src", e.target.result);
                                 }

                                 reader.readAsDataURL(ele.files[0]);
                             }
                 }
                 </script> -->
                 <div class="divstandard">
                 <?php echo $row['IMAGE'] ?>
                 <input type="file" name="imageProd" accept="image/*" OnChange="showPreview(this)">
                 <hr>
                 <img src="../../images/<?php echo $row['IMAGE'] ?>.jpg" class="rounded mx-auto d-block" style="width: 500px;height:300px;margin-bottom: 50px;">
                 </div>
                 <div class="form-row">
                 <div class="form-group col-md-6">
                     <label>Nom Produit</label>
                     <input type="text" class="form-control" name="nomProduit" required value="<?php echo $rows["NOM"]?>">
                 </div>
                 <div class="form-group col-md-6">
                     <label>Prix en Dh</label>
                     <input type="number" min="0.01" class="form-control" name="prix" step="0.01" required value="<?php echo $rows["Prix"]?>">
                 </div>
                 </div>
                 <div class="form-group">
                 <label>quantité en stock</label>
                 <input type="number" min="0" class="form-control" name="qteStock" required value="<?php echo $rows["qte"]?>">
                 </div>
                 <div class="form-row">
                 <div class="form-group col-md-3">
                     <label>Produit dans panier standard</label>
                     <input class="form-control" type="checkbox" name="panierStandard" ';if($rows["produtit_panier_standard"]==1){echo "checked";}echo'>
                 </div>
                 <div class="form-group col-md-4">
                     <label>Quantité dans panier standard</label>
                     <input type="number" min="0" class="form-control" name="quantitepanier" required value="'.$rows["qte_ligne_panier_standard"].'">
                 </div>
                 <div class="form-group col-md-5">
                     <label>Catégorie</label>
                     <select class="form-control" name="categorieselect">
                     ';<?php
                     $sql = "SELECT * FROM categorie  ORDER BY `categorie`.`ID_CAT` ASC";
                     $result = $conn->query($sql);

                     if ($result->num_rows > 0) {
                         while($row = $result->fetch_assoc()) {
                                 echo '<option value="'. $row["ID_CAT"].'"';if($rows["ID_CAT"]==$row["ID_CAT"]){
                                 echo 'selected="selected"';} 
                                 echo'>'. $row["DESC_cat"].'</option>';
                         }
                     } 
                     else {
                     echo '<option>voulez vous ajouter les catégories</option>';
                     }
                     echo '</select>
                 </div>
                 </div>
                     <button type="submit" class="btn btn-light btn-lg" name="updateProduit">Modifier</button>
                     <button type="submit" class="btn btn-light btn-lg" name="deleteProduit">Supprimer</button>
                     <input type="button" value="Annuler" onClick="javascript:history.go(-1)" class="btn btn-light btn-lg"/>
                 </div>
             </form>';  
              endwhile; ?>
             // <?php
     } 
     else {
         echo '<div class="divstandard">
         <p class="text-center font-weight-bolder">Id de produit et invalide</p></div>';
     }
     $conn->close();
 
 else
 {
     echo '<div class="divstandard">
     <p class="text-center font-weight-bolder">Aucun produit sélectionné</p></div>';
 }





 if(isset($_POST['updateProduit']))
 {
     $conn = new mysqli("localhost", "root", "", "shop");
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     $nomProd=$_POST['nomProduit'];
     $sql = "select NOM from produit where ID_PRD<>$id and NOM='".$nomProd."'";
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {
         echo "<script>alert(\"nom de produit est deja exist\")</script>";
         $conn->close();
     }
     else
     {
         $conn = new mysqli("localhost", "root", "", "shop");
         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         $idCat=$_POST['categorieselect'];
         $prix=$_POST['prix'];
         $qteStock=$_POST['qteStock'];
         $panierStandard=0;
         if(isset($_POST['panierStandard'])){
         $panierStandard=1;
         }
         $quantitepanier=$_POST['quantitepanier'];
         $sql = "UPDATE produit SET ID_CAT=$idCat, NOM='$nomProd', prix=$prix, QTE_MAX=$qteStock, produtit_panier_standard=$panierStandard , qte_ligne_panier_standard=$quantitepanier where ID_PRD=$id";
         if($_FILES['imageProd']['tmp_name'])
         {
             $imageProduit=addslashes(file_get_contents($_FILES['imageProd']['tmp_name']));
             $sql = "UPDATE produit SET IMAGE='$imageProduit', ID_CAT=$idCat, NOM='$nomProd', prix=$prix, QTE_MAX=$qteStock, produtit_panier_standard=$panierStandard , qte_ligne_panier_standard=$quantitepanier where ID_PRD=$id";
         }
         if ($conn->query($sql) === TRUE) {
             echo "<script>alert(\"modification de la produit terminer avec succès\")</script>";
         } else {
             echo "Error: ";
         }
         $conn->close();
         echo '<script>javascript:history.go(-2);</script>';
     }
 }


 if(isset($_POST['deleteProduit']))
 {
     $conn = new mysqli("localhost", "root", "", "shop");
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     $sql = "SELECT * FROM `produit` where ID_PRD=".$id;
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {
         
     $sql = "DELETE FROM `produit` WHERE ID_PRD='".$id."'";
         if ($conn->query($sql) === TRUE) {
             echo "<script>alert(\"suppression de produit terminer avec succès\")</script>";
             echo '<script>javascript:history.go(-2);</script>';
         } 
         else {
             echo "Error: ";
         }
         $conn->close();
     }
 }
?>
