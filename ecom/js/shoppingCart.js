function refreshCart() {
  let cartItems = localStorage.getItem("items");
  if (cartItems !== null) {
    cartItems = JSON.parse(cartItems);
    cartItems = cartItems.length;
  } else {
    cartItems = 0;
  }

  document.getElementById("cart-items").innerText = cartItems;
}

refreshCart();

const addToCart = document.getElementsByClassName("addToCart");
console.log(addToCart.length);

let items = [];
for (let i = 0; i < addToCart.length; i++) {
  addToCart[i].addEventListener("click", function (e) {
    e.preventDefault();

    if (typeof Storage !== "undefined") {
      let product = e.target.closest(".product");
      let productId = product.querySelector(".product-id").innerText;
      let productTitle = product.querySelector(".product-title").innerText;
      let productImage = product
        .querySelector(".product-image")
        .getAttribute("src");
      let productPrice = product
        .querySelector(".price")
        .innerText.replace("$", "");

      let item = {
        id: productId,
        image: productImage,
        name: productTitle,
        price: productPrice,
      };

      items.push(item);

      localStorage.setItem("items", JSON.stringify(items));

      refreshCart();
    } else {
      console.log("storage is not working on your browser");
    }
  });
}
