
// load all data
loadPHP(".notif-count", "../operations/getUnreadNotif.php");
loadPHP(".cart-count", "../operations/getCartCount.php");
loadPHP(".cart-body", "../operations/getCarts.php");
loadPHP(".purchase-body", "../operations/getPurchases.php");
// loadPHP(".listing-body", "../operations/fetchListings.php");
// loadPHP(".trash-body", "../operations/fetchTrash.php");






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

function add(btn, id) {
    let row = $(btn).closest("tr");
    let qtyField = $(row).find(".qty-field");
    let qty = parseInt(qtyField.val());

    qty += 1;
    qtyField.val(qty);

    updateQty(qty, id);
}

function subtract(btn, id) {
    let row = $(btn).closest("tr");
    let qtyField = $(row).find(".qty-field");
    let qty = parseInt(qtyField.val());

    if(qty == 1)
        return;

    qty -= 1;
    qtyField.val(qty);

    updateQty(qty, id);
}

function updateQty(qty, id) {
    $.ajax({
        url: "../operations/updateQty.php",
        type: "post",
        data: {pID: id, qty: qty},
        success: function(result) {
            window.location.href="cart.php";
        }
    })
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
    requestSearch();
})

$("#apply-btn").on("click", function() {
    requestSearch();    
});

$("#condition").change( function() {
    requestSearch(); 
});

$("#price-order").change( function() {
    requestSearch();
});


function requestSearch() {
    let search = $("#searchField").val();
    let category = $("#category-filter").val();
    let min = $("#min").val();
    let max = $("#max").val();
    let condition = $("#condition").val();
    let priceOrder = $("#price-order").val();

    let link = "products.php?";

    if(search) 
        link += `search=${search}&`;

    if(category)
        link += `category=${category}&`;

    if(min)
        link += `min=${min}&`;

    if(max)
        link += `max=${max}&`;

    if(condition)
        link += `condition=${condition}&`;

    if(priceOrder) 
        link += `price_order=${priceOrder}`;

    window.location.href = link;
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

                    // loadPHP(".listing-body", "../operations/fetchListings.php");
                    window.location.reload();
                }
            });
        }
    });
}

function deleteItem(productID, productName) {
    Swal.fire({
        icon: "warning",
        title: `Do you want to delete <b>${productName}</b>?`,
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes"
    })
    .then((result) => {

        if(result.isConfirmed) {
            $.ajax({
                url: "../operations/deleteTrash.php",
                type: "POST",
                data: {product_id: productID},
                success: function(result) {

                    window.location.reload();
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
                    // loadPHP(".trash-body", "../operations/fetchTrash.php");
                    window.location.reload();
                }
            });
        }
    });
}