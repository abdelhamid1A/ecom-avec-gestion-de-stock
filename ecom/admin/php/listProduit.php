<?php
    include('menu.php');
    echo '<div class="divstandard">';
    $conn = new mysqli("localhost", "root", "", "shop");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `produit` ORDER BY `produit`.`ID_PRD` ASC ";
    $result = mysqli_query($conn, $sql);  
                  
    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while($row = mysqli_fetch_array($result))  
                {  
                    echo '<div class="col-sm-4 cardProduit">
                    <div class="card">
                    <img src="data:image/jpeg;base64,'.base64_encode($row['IMAGE'] ).'" class="card-img-top" height="200" />  
                    <div class="card-body">
                        <h5 class="card-title">'.$row['NOM'].'</h5>    
                        <a href="updateDeleteProduit.php?id='.$row["ID_PRD"].'"><button type="button" name="detailProduit" class="btn btn-light btn-lg">Détails</button></a>
                        <p class="card-text text-right">'.$row['Prix'].' Dh</p>
                    </div>
                    </div>
                    </div>';  
                }
        echo '</div>';
       
    } 
    else {
    echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
    }
    $conn->close();
    echo '<a href="addProduit.php"><button type="button" class="btn btn-light btn-lg">Ajouter Produit</button></a></div>';
    
?>