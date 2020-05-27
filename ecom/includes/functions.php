<?php
session_start();
ob_start();
require('includes/conect.php');
// fuction redirect 

function query($sql)
{
    global $con;
    return mysqli_query($con, $sql);
}
function redirect($page)
{
    header('location:' . $page);
}
function logout()
{
    $_SESSION['log'] = false;
    session_destroy();
    redirect('index.php');
}


// get product from database

function getPro()
{
    global $con;
    $get_pro = "select * from produit order by ID_PRD ASC LIMIT 8";
    $run_pro = mysqli_query($con, $get_pro);
    $products_html = "  
        <div class='container'>
        <div class='row'>";
    while ($row_pro = mysqli_fetch_array($run_pro)) {
        $pro_id = $row_pro['ID_PRD'];
        $pro_mat = $row_pro['MATRICULE'];
        $pro_cat = $row_pro['ID_CAT'];
        $pro_nom = $row_pro['NOM'];
        $pro_QTE = $row_pro['QTE_MAX'];
        $pro_img = $row_pro['IMAGE'];

        $products_html .= "<div class='col-md-6 col-lg-3 ftco-animate'>
                <div class='product'>
                    <span style='display:none' class='product-id'>$pro_id</span>
                    <a href='#' class='img-prod'> <img class='product-image img-fluid' src='data:image/jpeg;base64," . base64_encode($pro_img) . "' width='180' height='180'/>
                        <div class='overlay'></div>
                    </a>
                    <div class='text py-3 pb-4 px-3 text-center'>
                        <h3><a href='#' class='product-title'>$pro_nom</a></h3>
                        <div class='d-flex'>
                            <div class='pricing'>
                                <p class='price'><span>$pro_QTE$</span></p>
                            </div>
                        </div>
                        <div class='bottom-area d-flex px-3'>
                            <div class='m-auto d-flex'>
                                <a href='#' class='buy-now d-flex justify-content-center align-items-center mx-1 addToCart'>
                                    <span><i class='ion-ios-cart'></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    }
    $products_html .= "</div>
    </div>";

    return $products_html;
}