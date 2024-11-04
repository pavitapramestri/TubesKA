<?php

function card($productname, $productimg, $productprice, $productid)
{
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"index.php\" method=\"POST\">
            <div class=\"card shadow\">
                <div>
                    <img src=\"./upload/$productimg\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <h6>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"far fa-star\"></i>
                    </h6>
                    <p class=\"card-text\">Some quick example text to build on the card.</p>
                    <h5 class=\"price\">$$productprice</h5>
                    <button type=\"submit\" name=\"add\" class=\"btn btn-warning my-3\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$productid\">
                </div>
            </div>
        </form>
    </div>
    
    ";
    echo ($element);
}



function cartElement($productimg, $productname, $productprice, $productid)
{
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
        <div class=\"border rounded\">
            <div class=\"row bg-white\">
                <div class=\"col-md-3 pl-0\">
                    <img src=\"./upload/$productimg\" class=\"img-fluid\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productname</h5>
                    <small class=\"text-secondary\">Seller: Bintank</small>
                    <h5 class=\"pt-2\">$$productprice</h5>
                    <button type=\"submit\" class=\"btn btn-warning\">Save for later</button>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                </div>
                <div class=\"col-md-3 py-5\">
                    <div>
                        <button type=\"button\" class=\"btn btn-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                        <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                        <button type=\"button\" class=\"btn btn-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    ";
    echo ($element);
}
