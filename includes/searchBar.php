<div class="container-fluid bg-primary py-3 search-nav">
    <div class="container-xxl d-flex justify-content-center align-items-center gap-5">
        <form action="products.php" method="get" class="w-100" style="max-width: 700px">
            <div class="input-group">
                <input type="text" name="search" id="searchField" placeholder="Search here..." class="form-control rounded-0" value="<?php echo (isset($search) ? $search : '') ?>">

                <button class="btn bg-dark rounded-0 text-light"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>

        <a href="cart.php" class="cart-container text-decoration-none d-flex align-items-center gap-2">
            <span class="text-light"><i class="fa-solid fa-cart-shopping h4"></i></span>

            <span class="text-light cart-count" style="user-select: none;">99</span>
        </a>
    </div>
</div>