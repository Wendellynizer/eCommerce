<?php 
	require_once "config/connection.php";
	$conn = DB::connect();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
      <title>ChipTech | Home</title>
      <link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  
  <body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
		<div class="container-fluid">
			<a class="navbar-brand fs-4" href="Home.html">
			<img src="assets/images/logo/logo.png" alt="" width="30px" height="30px" class="d-inline-block align-text-top">
				ChipTech
			</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
				<div class="offcanvas-header text-light border-bottom">
					<a class="navbar-brand fs-4" href="Home.html">

					<img src="assets/images/logo/Logo.png" alt="" width="30px" height="30px" class="d-inline-block align-text-top">
					ChipTech
					</a>

					<button type="button " class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas"></button>
				</div>

				<div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
					<ul class="navbar-nav justify-content-center align-items-center flex-grow-1 fs-5 pe-3">
						<li class="nav-item mx-2">
							<a class="nav-link active" href="Home.html">Home</a>
						</li>

						<!--Dropdown Nav-link-->
						<li class="nav-item dropdown mx-2">
							<a class="nav-link dropdown-toggle" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown">
								Categories
							</a>

							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="processor.html">Processor</a></li>
								<li><a class="dropdown-item" href="ram.html">RAM</a></li>
								<li><a class="dropdown-item" href="gpu.html">GPU</a></li>
								<li><a class="dropdown-item" href="Motherboard.html">Motherboard</a></li>
							</ul>
						</li>

						<li class="nav-item mx-2">
							<a class="nav-link" href="about.html">About Us</a>
						</li>

						<li class="nav-item mx-2">
							<a class="nav-link mx-2" href="HowToBuy.html">How to Buy</a>
						</li>

						<li class="nav-item mx-2">
							<a class="nav-link" href="warranty.html">Warranty</a>
						</li>
					</ul>

					<div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
						<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="/Images/Home Images/cart-svgrepo-com.png" alt="Cart" width="30px"></a>
						<a href="Login.html" class="text-dark text-decoration-none px-3 py-1" style="background-color: white; border-radius: 1rem;">Login</a>
						<a href="Signup.html" class="text-dark text-decoration-none px-3 py-1" style="background-color: white; border-radius: 1rem;">Sign up</a>
					</div>
				</div>
			</div>
		</div>
	</nav> 
	<!--Navbar End-->

	<!--Modal-->
	<div class="modal fade" id="exampleModal" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Shopping Cart</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="card mb-3" style="max-width: 540px;">
						<a type="button" class=" position-absolute top-0 end-0 me-1"><img src="/Images/Home Images/cancel-close-svgrepo-com.png" alt="" style="width: 10px; height: 10px;"></a>
						
						<div class="row g-0">
							<div class="col-md-6 my-auto">
								<img src="/Images/GPU/Nvidia/ASUS GeForce RTX 4090 24GB ROG Strix OC GDDR6X Graphics Card.png" class="card-img-top" alt="">
							</div>

							<div class="col-md-6">
								<div class="card-body">
									<h5 class="card-title">ASUS GeForce RTX 4090 24GB ROG Strix OC GDDR6X Graphics Card</h5>
									<p class="card-text fs-5">₱129,895.00</p>
									<div class="input-group mb-3" style="width: 120px;">
										<button class="btn btn-outline-secondary" type="button" id="button-minus">-</button>
										<input type="text" class="form-control text-center" value="1" min="1" max="100" id="quantity">
										<button class="btn btn-outline-secondary" type="button" id="button-plus">+</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<hr>

					<div class="card mb-3" style="max-width: 540px;">
						<a type="button" class="position-absolute top-0 end-0 me-1" > <img src="/Images/Home Images/cancel-close-svgrepo-com.png" alt="" style="width: 10px; height: 10px;"></a>

						<div class="row g-0">
							<div class="col-md-6 my-auto">
								<img src="/Images/Processors/Amd Processor/AMD Ryzen 5 5600 6-Core 3.5 GHz Socket AM4 65W 100-100000927BOX Desktop Processor.png" class="card-img-top" alt="">
							</div>

							<div class="col-md-6">
								<div class="card-body">
									<h5 class="card-title">AMD Ryzen 5 5600 6-Core 3.5 GHz Socket AM4 65W 100-100000927BOX Desktop Processor</h5>
									<p class="card-text fs-5">₱7,895.00</p>
									<div class="input-group mb-3" style="width: 120px;">
										<button class="btn btn-outline-secondary" type="button" id="button-minus">-</button>
										<input type="text" class="form-control text-center" value="1" min="1" max="100" id="quantity">
										<button class="btn btn-outline-secondary" type="button" id="button-plus">+</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<a href="#" class="btn text-light" style="border-radius: 1rem; background-color: #121212;">Checkout</a>
				</div>
			</div>
		</div>
    </div>

	<!--Carousel-->
    <div class="container-fluid" style="background-color: #121212;">
		<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="row align-items-center text-light">
						<div class="col-md-6">
							<div class="ms-5 mt-5"> 
								<h1 class="mb-5">Gigabyte Radeon RX 6600 EAGLE 8GB Triple Fan Video Card GV-R66EAGLE-8GD</h1>
								<p class="text-center fs-4">Specifications:</p>
								<ul class="fs-4">
									<li>Powered by AMD RDNA™ 2 Radeon™ RX 6600</li>
									<li>Integrated with 8GB GDDR6 128-bit memory interface</li>
									<li>WINDFORCE 3X Cooling System with alternate spinning fans</li>
									<li>Screen cooling</li>
									<li>Graphene nano lubricant</li>
									<li>Protection back plate</li>
								</ul>
							</div>
						</div>
              			
						<div class="col-md-6 d-flex">
							<img src="/Images/GPU/Amd GPU/Gigabyte Radeon RX 6600 EAGLE 8GB Triple Fan Video Card GV-R66EAGLE-8GD.png" alt="" class="img-fluid">
              			</div>
            		</div>
          		</div>

				<div class="carousel-item">
					<div class="row align-items-center text-light">
						<div class="col-md-6">
							<div class="ms-5 mt-5">
							<h1 class="mb-5">ASUS GeForce RTX 4090 24GB ROG Strix OC GDDR6X Graphics Card</h1>
							<p class="text-center fs-4">Specifications:</p>
							<ul class="fs-4">
								<li><strong>NVIDIA Ada Lovelace Streaming Multiprocessors:</strong>Up to 2x performance and power efficiency</li>
								<li><strong>4th Generation Tensor Cores:</strong>Up to 2X AI performance</li>
								<li><strong>3rd Generation RT Cores:</strong>Up to 2X ray tracing performance</li>
								<li><strong>Axial-tech fans</strong>scaled up for 23% more airflow</li>
								<li><strong>New patented vapor chamber</strong>with milled heatspreader for lower GPU temps<strong>&nbsp;</strong></li>
								<li><strong>3.5-slot design</strong><strong>:</strong>massive fin array optimized for airflow from the three Axial-tech fans</li>
								<li><strong>Diecast shroud, frame, and backplate</strong>add rigidity and are vented to further maximize airflow and heat dissipation</li>
								<li><strong>Digital power</strong><strong>control</strong>with high-current power stages and 15K capacitors to fuel maximum performance</li>
								<li><strong>Auto-Extreme;</strong>precision automated manufacturing for higher reliability</li>
								<li><strong>GPU Tweak</strong>software provides intuitive performance tweaking, thermal controls, and system monitoring</li>
								<li>RAM: 24GB of GDDR6X</li>
								<li>CUDA Cores: 16384</li>
								<li>Base clock: 2235 Mhz</li>
								<li>Bus width: 384-bit</li>
								</ul>
							</div>
						</div>

						<div class="col-md-6 d-flex">
							<img src="/Images/GPU/Nvidia/ASUS GeForce RTX 4090 24GB ROG Strix OC GDDR6X Graphics Card.png" alt="" class="img-fluid">
						</div>
					</div>
				</div>

				<div class="carousel-item">
					<div class="row align-items-center text-light">
						<div class="col-md-6">
							<div class="ms-5 mt-5">
								<h1 class="mb-5">Gigabyte Radeon RX 7900 XT Gaming OC 20GB GDDR6 320Bit Graphics Card GV-R79XTGAMING OC-20GD</h1>
								<p class="text-center fs-4">Specifications:</p>
								<ul class="fs-4">
									<li>Powered by Radeon™ RX 7900 XT</li>
									<li>Integrated with 20GB GDDR6 320-bit memory interface</li>
									<li>WINDFORCE Cooling System</li>
									<li>RGB Fusion</li>
									<li>Dual BIOS</li>
									<li>Protection metal back plate</li>
									<li>Anti-sag bracket</li>
								</ul>
							</div>
						</div>

						<div class="col-md-6 d-flex">
							<img src="/Images/GPU/Amd GPU/Gigabyte Radeon RX 7900 XT Gaming OC 20GB GDDR6 320Bit Graphics Card GV-R79XTGAMING OC-20GD.png" alt="" class="img-fluid">
						</div>
					</div>
				</div>
        	</div>

			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
			<span class="carousel-control-prev-icon"></span>
			<span class="visually-hidden">Previous</span>
			</button>

			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
			<span class="carousel-control-next-icon"></span>
			<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
	<!-- Carousel End -->
    
	<!--Items-->
	<div class="container-fluid my-5">
		<h3 class="fw-bolder">Top Deals!</h3>
		
		<div class="row mx-5 mt-1 g-5">
			<div class="col-md-6 border border-dark text-center p-2">
				<img class="img-fluid" src="/Images/Processors/Amd PRocessor/AMD Ryzen 5 5500 6-Core 3.6 GHz Socket AM4 65W 100-100000457BOX Desktop Processor.png" width="200" alt="">
				<p class="display-6 fs-3 fw-bold mt-4 text-start">AMD Ryzen 5 5500 6-Core 3.6 GHz Socket AM4 65W 100-100000457BOX Desktop Processor</p>
				<h4 class="text-start">₱7,595.00</h4>
				<br>

				<div class="container-fluid d-flex justify-content-end p-0">
					<a href="" class="btn btn-outline-dark">Add to Cart</a>
				</div>
				
			</div>

			<div class="col">
				<div class="row border border-dark mb-2 p-2">
					<div class="col-md-6 text-center">
						<img class="img-fluid" src="/Images/GPU/Nvidia/ASUS GeForce RTX 4090 24GB ROG Strix OC GDDR6X Graphics Card.png" width="150" alt="">
					</div>

					<div class="col">
						<p class="display-6 fs-5 fw-bold mt-4 text-start">ASUS GeForce RTX 4090 24GB ROG Strix OC GDDR6X Graphics Card</p>
						<h4>₱129,895.00</h4>

						<div class="container-fluid d-flex justify-content-end p-0">
							<a href="" class="btn btn-outline-dark">Add to Cart</a>
						</div>
					</div>
				</div>

				<div class="row border border-dark p-2">
					<div class="col-md-6 text-center">
						<img class="img-fluid" src="/Images/ram/Apacer Panther RGB 2x16B 6000MHz DDR5 CL40 Gaming Memory AH5U32G60C5129BAA-2.png" width="150" alt="">
					</div>

					<div class="col">
						<p class="display-6 fs-5 fw-bold mt-4 text-start">Apacer Panther RGB 2x16B 6000MHz DDR5 CL40 Gaming Memory AH5U32G60C5129BAA-2</p>
						<h4>₱8,950.00 <del>₱10,000.00</del></h4>

						<div class="container-fluid d-flex justify-content-end p-0">
							<a href="" class="btn btn-outline-dark">Add to Cart</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- test -->

	
    
	<footer class="py-4 bg-dark text-white text-center">
		<div class="container">
		<p>&copy; 2023 ChipTech. All rights reserved.</p>
		</div>
	</footer>
  </body>
</html>