$(document).ready(function() {
    new DataTable(".table");
});

// load all data
loadPHP(".notif-count", "../operations/getUnreadNotif.php");
loadPHP(".cart-count", "../operations/getCartCount.php");
loadPHP(".cart-body", "../operations/getCarts.php");
loadPHP(".purchase-body", "../operations/getPurchases.php");
loadPHP(".listing-body", "../operations/fetchListings.php");
loadPHP(".trash-body", "../operations/fetchTrash.php");






//init price for cart
// alert($(".qty-field").val());

// AJAX Change Status
function changeStatus(orderId, btn) {

    let statusId = 0;
    let row = $(btn).closest("tr");
    let currentStatus = $(row).find("td:eq(6)").text();

    if(currentStatus == "Pending") {
        statusId = 2;
        $(btn).html("Deliver");

    } else if(currentStatus == "Shipping") {
        statusId = 3;
        $(btn).html("Complete");

    } else if(currentStatus == "Delivering") {
        statusId = 4;
        $(btn).prop('disabled', true);

    } else if(currentStatus == "Complete") {
        statusId = 5;
        $(btn).html("Complete");

   } else if(currentStatus == "Cancelled") {
        statusId = 6;
        $(btn).prop('disabled', true);
    }

    let qty = $(row).find("td:eq(4)").text(); //* acquiring quantity

    console.log(statusId);


    $.ajax({
        url: '../operations/changeStatus.php',
        type: 'POST',
        data: {order_id: orderId, status_id: statusId, qty: qty},
        success: function(result) {

            let status = result;

            // change element value
            if(status == "Pending") {
                $(row).find("td:eq(6)").html("<span class='badge bg-pending'>Pending</span></td>");
            } else if(status == "Shipping") {
                $(row).find("td:eq(6)").html("<span class='badge bg-shipping'>Shipping</span></td>");

            } else if(status == "Delivering") {
                $(row).find("td:eq(6)").html("<span class='badge bg-delivering'>Delivering</span></td>");

            } else if(status == "Complete") {
                $(row).find("td:eq(6)").html("<span class='badge bg-complete'>Complete</span></td>");

            } else if(status == "Cancelled") {
                $(row).find("td:eq(6)").html("<span class='badge bg-cancelled'>Cancelled</span></td>");
            }
            

            if(status != "Shipping") 
                return;

            // SUCCESS SWEET ALERT
            Swal.fire({
                icon: 'success',
                title: 'Order has been shipped',
                showConfirmButton: false,
                timer: 1000

            }).then((result) => {
                if(result.dismiss === Swal.DismissReason.timer) {
                    console.log("Order Shipped for Order ID: "+orderId);
                }
            });

        },

        error: function() {
            console.log("error");
        }
    });
};

//* cart

function addToCart() {

    loadPHP(".cart-count", "../operations/getCartCount.php");

    $.ajax({
        url: '../operations/addToCart.php',
        type: 'POST',
        data: $('#productForm').serialize(),
        success: function(result) {

            Swal.fire({
                icon: 'success',
                title: 'Added to Cart',
                showConfirmButton: false,
                timer: 1000
            });

        },
        error: function(xhr, ststus, error) {
            console.log(error);
        }
    });
}

function deleteCart(cartID) {

    Swal.fire({
        icon: 'warning',
        title: 'Delete item from cart?',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    })
    .then((result) => {

        if(!result.isConfirmed) {
            return;
        }

        $.ajax({
            url: '../operations/deleteItemFromCart.php',
            type: 'POST',
            data: {cart_id: cartID},
            success: function(result) {
                loadPHP(".cart-body", "../operations/getCarts.php");
            },
            error: function(xhr, ststus, error) {
                console.log(error);
            }
        });
    });
}

// helper
function loadPHP(className, url) {
    $(className).load(url);
}

function add(btn) {
    let row = $(btn).closest("tr");
    let qtyField = $(row).find(".qty-field");
    let qty = parseInt(qtyField.val());

    qty += 1;
    qtyField.val(qty);
}

function subtract(btn) {
    let row = $(btn).closest("tr");
    let qtyField = $(row).find(".qty-field");
    let qty = parseInt(qtyField.val());

    if(qty == 1)
        return;

    qty -= 1;
    qtyField.val(qty);
}

function addCountToProduct() {
    let qty = $(".qty-field").val();
    $(".qty-field").val(++qty);
}

function subtractCountToProduct() {
    let qty = $(".qty-field").val();

    if(qty == 1)
        return;

    $(".qty-field").val(--qty);
}


$("#category-filter").change( function() {
    
    let search = $("#searchField").val();
    let category = $(this).val();

    let link = "products.php?";

    if(search) 
        link += "search="+search;

    if(category)
        link += "&category="+category;

    window.location.href = link;

    // requestSearch(search, category);
})

function requestSearch(search, category) {

    
    // let searchR = (search) ? search : '';
    // let catR = (category) ? category : 0;

    let link = "../operations/filterProducts.php?";

    if(search) 
        link += "search="+search;

    if(category)
        link += "category="+category;

    loadPHP(".product-body", link);

    // $.ajax({
    //     url: '../operations/filterProducts.php',
    //     type: 'GET',
    //     data: {search: searchR, category_name: catR},
    //     success: function(result) {
    //         // alert(result);
    //        loadPHP(".product-body", '../operations/filterProducts.php?');

    //     },

    //     error: function() {
    //         console.log("error");
    //     }
    // });
}

function trashItem(productID, productName) {
    Swal.fire({
        icon: "warning",
        title: `Trash <b>${productName}</b>?`,
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes"
    })
    .then((result) => {

        if(result.isConfirmed) {
            $.ajax({
                url: "../operations/trashItem.php",
                type: "POST",
                data: {product_id: productID},
                success: function(result) {

                    loadPHP(".listing-body", "../operations/fetchListings.php");
                }
            });
        }
    });
}

function restoreTrash(productID, productName) {
    Swal.fire({
        icon: "warning",
        title: `Restore <b>${productName}</b>?`,
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes"
    })
    .then((result) => {

        if(result.isConfirmed) {
            $.ajax({
                url: "../operations/restoreTrash.php",
                type: "POST",
                data: {product_id: productID},
                success: function(result) {
                    loadPHP(".trash-body", "../operations/fetchTrash.php");
                }
            });
        }
    });
}