$(document).ready(function () {
  //add to cart
  $(".add-to-cart").on("click", function (e) {
    e.preventDefault();
    console.log("add clicked");
    $.ajax({
      url: "function.php",
      method: "POST",
      data: { id: $(this).data("id"), action: "add" },
      dataType: "JSON",
    }).done(function (response) {
      console.log(response);
      displaylist(response);
    });
  });

  //remove product from cart
  $(document).on("click", "#removeProduct", function (e) {
    e.preventDefault();
    console.log("remove product" + $(this).data("id"));
    $.ajax({
      url: "function.php",
      method: "POST",
      data: { id: $(this).data("id"), action: "remove" },
      dataType: "JSON",
    }).done(function (response) {
      displaylist(response);
    });
  });

  //display cart product
  function displaylist(response) {
    console.log("display called...");
    var table = "";
    table +=
      "<table><tr><th>Product Id</th><th>Product Name</th><th>Product Price</th><th>Product Qnty</th><th>Total Price</th><th>Remove</th></tr>";
    for (var key in response) {
      table +=
        "<tr><td>" +
        response[key]["id"] +
        "</td>\
                        <td>" +
        response[key]["name"] +
        "</td>\
                        <td>" +
        response[key]["price"] +
        "</td>\
                        <td>" +
        response[key]["quantity"] +
        "</td>\
                        <td>" +
        response[key]["tPrice"] +
        '</td>\
                        <td><a class="add-to-cart" data-id="' +
        response[key]["id"] +
        '" id="removeProduct" href="products.php?id=' +
        response[key]["id"] +
        '&action=removeProduct" >X</a></td>\
                        </tr>';
    }
    table += "</table>";
    $("#cart").html(table);
  }
});
