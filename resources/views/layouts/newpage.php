<?php
include ('htmlheader.php');
include ('webnavheader.php');
?>
<div class="row ">
	<div class="col-12 p-4" id="shortalert">
		<div class="alert bg-gray" role="alert">
			<p class=""> Alert Title </p>
			<p class=""> This an alert window </p>
		</div> <!-- ./alert -->
	</div> <!-- col12 -->
</div> <!-- ./row -->
<div class="row ">
	<div class="col-12 py-2" id="bannercolumn" >
		<div id="bannersite" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-target="#bannersite" data-slide-to="0" class="active"></li>
		    <li data-target="#bannersite" data-slide-to="1"></li>
		    <li data-target="#bannersite" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img src="assets/uploads/banner1.jpeg" class="d-block w-100" alt="Banner Image">
		    </div>
		    <div class="carousel-item">
		      <img src="assets/uploads/banner2.jpeg" class="d-block w-100" alt="Banner Image">
		    </div>
		    <div class="carousel-item">
		      <img src="assets/uploads/banner3.jpeg" class="d-block w-100" alt="Banner Image">
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#bannersite" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div> <!-- ./bannersite -->
	</div> <!-- col12 -->
</div> <!-- ./row -->

<div class="row ">
	<div class="col-12 py-2" id="longalertcolumn">
		<div class="jumbotron">
			  <p class=""> Long Alert title </p>
			  <p class="">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
			  <hr class="my-4">
			  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			  <a class="btn btn-primary " href="#" role="button">Learn more</a>
			</div> <!-- jumbotron -->
	</div> <!-- col12 -->
</div> <!-- ./row -->

<div class="row py-5">
	<div class="col-12 py-2" id="aboutownercolumn">
		<div class="card-body"> 
			<div class="row">
				<div class="col-md-3 text-center">
					<img src="assets/uploads/user3.jpg" class="authorimage" alt="owner">
					<p class=""> Name of author </p>
					<p class=""> Designation of author </p>
				</div> <!-- ./col-3 -->
				<div class="col-md-3 text-center">
					<img src="assets/uploads/user2.jpg" class="authorimage" alt="owner">
					<p class=""> Name of author </p>
					<p class=""> Designation of author </p>
				</div> <!-- ./col-3 -->
				<div class="col-md-6 ">
					<p class=""> Title of Authors </p>
					<p class=""> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<button class="btn btn-sm btn-flat readmorebtn" ><i class="fas fa-angle-double-right"></i>&nbsp;Read More</button>
				</div> <!-- ./col-3 -->
			</div> <!-- ./inner-row -->
		</div> <!-- ./card-body -->
	</div> <!-- col12 -->
</div> <!-- ./row -->

<div class="row py-5">
	<div class="col-md-3 py-2">
		<div class="card">
		  <img src="assets/uploads/act1.jpg" class="card-img-top previewcard" alt="gallery-preview">
		  <div class="card-body previewcardbody text-center">
		    <p class=""> Title </p>
		    </div> <!-- ./card-body -->
		</div> <!-- ./card -->
	</div> <!-- col12 -->
	<div class="col-md-3 py-2">
		<div class="card">
		  <img src="assets/uploads/act2.jpg" class="card-img-top previewcard" alt="gallery-preview">
		  <div class="card-body previewcardbody text-center">
		    <p class=""> Title </p>
		    </div> <!-- ./card-body -->
		</div> <!-- ./card -->
		
	</div> <!-- col12 -->
	<div class="col-md-3 py-2">
		<div class="card">
		  <img src="assets/uploads/act3.jpg" class="card-img-top previewcard" alt="gallery-preview">
		  <div class="card-body previewcardbody text-center">
		    <p class=""> Title </p>
		    </div> <!-- ./card-body -->
		</div> <!-- ./card -->
		
	</div> <!-- col12 -->
	<div class="col-md-3 py-2">
		<div class="card">
		  <img src="assets/uploads/act4.jpg" class="card-img-top previewcard" alt="gallery-preview">
		  <div class="card-body previewcardbody text-center">
		    <p class=""> Title </p>
		    </div> <!-- ./card-body -->
		</div> <!-- ./card -->
	</div> <!-- col12 -->
</div> <!-- ./row -->

<div class="row ">
	<div class="col-12 py-2">
		<div class="card-body  ">
		     <ul class="list-group activitycard" >
				  <li class="list-group-item listheadmain" > Recent Activities</li>
				  <li class="list-group-item listmainitem text-left px-5"> 
				  	<span class="px-2 fg-darkCrimson"> <i class="fas fa-caret-right fg-darkRed"></i> &nbsp; There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </span> 
				  	<span class="lisitemaction px-2 fg-darkCrimson"> <i class="fas fa-calendar-alt"></i> 14.04.2020 
				  		<button class="btn btn-sm ribbed-lightRed bg-lightGreen-hover  "> <i class="fas fa-hand-point-right"></i>&nbsp;View details </button> </span>  
				  </li>
				  
				  <li class="list-group-item listmainitem text-left px-5"> 
				  	<span class="px-2 fg-darkCrimson"> <i class="fas fa-caret-right fg-darkRed"></i> &nbsp; There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </span> 
				  	<span class="lisitemaction px-2 fg-darkCrimson"> <i class="fas fa-calendar-alt"></i> 14.04.2020 
				  		<button class="btn btn-sm ribbed-lightRed bg-lightGreen-hover  "> <i class="fas fa-hand-point-right"></i>&nbsp;View details </button> </span>  
				  </li>

				  <li class="list-group-item listmainitem text-left px-5"> 
				  	<span class="px-2 fg-darkCrimson"> <i class="fas fa-caret-right fg-darkRed"></i> &nbsp; There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </span> 
				  	<span class="lisitemaction px-2 fg-darkCrimson"> <i class="fas fa-calendar-alt"></i> 14.04.2020 
				  		<button class="btn btn-sm ribbed-lightRed bg-lightGreen-hover  "> <i class="fas fa-hand-point-right"></i>&nbsp;View details </button> </span>  
				  </li>

				  <li class="list-group-item listmainitem text-left px-5"> 
				  	<span class="px-2 fg-darkCrimson"> <i class="fas fa-caret-right fg-darkRed"></i> &nbsp; There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </span> 
				  	<span class="lisitemaction px-2 fg-darkCrimson"> <i class="fas fa-calendar-alt"></i> 14.04.2020 
				  		<button class="btn btn-sm ribbed-lightRed bg-lightGreen-hover  "> <i class="fas fa-hand-point-right"></i>&nbsp;View details </button> </span>  
				  </li>

				  <li class="list-group-item  listmainitem text-left px-5"> 
				  	<span class="px-2 fg-darkCrimson"> <i class="fas fa-caret-right fg-darkRed"></i> &nbsp; There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </span> 
				  	<span class="lisitemaction px-2 fg-darkCrimson"> <i class="fas fa-calendar-alt"></i> 14.04.2020 
				  		<button class="btn btn-sm ribbed-lightRed bg-lightGreen-hover  "> <i class="fas fa-hand-point-right"></i>&nbsp;View details </button> </span>  
				  </li>
				</ul>
		    </div> <!-- ./card-body -->
	</div> <!-- col12 -->
</div> <!-- ./row -->

<div class="row ">
	<div class="col-12 py-2">
		<div class="card articlecard py-3" id="firstarticle">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4 py-2 text-center align-items-middle">
						<img src="assets/uploads/user5.jpg" class="authorimage" alt="author">
					</div> <!-- ./col4 -->
					<div class="col-md-8 py-2" >
						<p class=""> Title of the article </p>
						<p class=""> author name </p>
						<p class="">
							Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

						</p>
						<button class="btn btn-sm btn-flat readmorebtn" ><i class="fas fa-angle-double-right"></i>&nbsp;Read More</button>
					</div> <!-- ./col8 -->
				</div> <!-- ./inner-card-row -->
			</div> <!-- ./card-body -->
		</div> <!-- ./card -->
	</div> <!-- col12 -->
	<div class="col-12 py-2">
		<div class="card articlecard py-3 my-3" id="secondarticle">
			<div class="card-body">
				<div class="row">
					
					<div class="col-md-8 py-2">
						<p class=""> Title of the article </p>
						<p class=""> author name </p>
						<p class="">
							Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
						</p>
						<button class="btn btn-sm readmorebtn" ><i class="fas fa-angle-double-right"></i>&nbsp;Read More</button>
					</div> <!-- ./col8 -->
					<div class="col-md-4 py-2 text-center align-items-middle">
						<img src="assets/uploads/user6.jpg" class="authorimage" alt="author">
					</div> <!-- ./col4 -->
				</div> <!-- ./inner-card-row -->
			</div> <!-- ./card-body -->
		</div> <!-- ./card -->


	</div> <!-- col12 -->
</div> <!-- ./row -->

<div class="row py-5">
	<div class="col-12 py-2" id="infodiv">
		<div class="card-body"> 
			<div class="row equal">
				<div class="col-md-2 d-md-block text-center align-middle pt-5">
					<i class="fas fa-info-circle fa-3x "></i>
				</div> <!-- ./col2 -->
				<div class="col-md-10">
					<p class=""> Title of div </p>
					<p class="">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
						
					</p>
					<button type="button" class="btn btn-sm col-md-3 requestbtn py-1"><i class="fas fa-quote-left"></i>&nbsp; Request for news letter</button>
					

				</div> <!-- ./col10 -->
			</div> <!-- ./row -->
		</div> <!-- ./card-body -->
	</div> <!-- ./col12 -->
</div> <!-- ./row -->


<div class="row ">
	<div class="col-12 py-2">
	<div class="card">
		<div class="card-body"> 
			<div class="row equal">
				<div class="col-md-4 py-3 text-center">
					<div class="card-body contactinfo contactdiv_one">
						<p class="contacttitle"> Title </p>
					<img src="assets/uploads/magazine.jpg" class="magazineposter" alt="owner">
					</div> <!-- ./contactdiv -->
				</div> <!-- ./col-3 -->
				<div class="col-md-4 py-3 ">
					<div class="card-body contactinfo contacttitle contactdiv_two spacedtext">
						<p class="text-center "> Title </p>
						Address line 1 <br>
						Address line 1 <br>
						Address line 1 <br>
						Address line 1 <br>
						<i class="fas fa-phone-alt"></i>&nbsp; 99999999999 <br>
						<i class="fas fa-at"></i>&nbsp; email@email.com <hr>
						<p class=""> Social Media title  <a href="" title=""><i class="fab fa-facebook  contacttitle"></i> </a> </p>
					</div> <!-- ./contactdiv --> 
				</div> <!-- ./col-3 -->
				<div class="col-md-4 py-3  text-center">
					<div class="card-body contactinfo contactdiv_three">
						<p class="contacttitle"> Title </p>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.611509550513!2d76.9624495496608!3d8.439755793901169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b05a52aa94e35b7%3A0xb2bc2f81bdc7c7c7!2sCDIT%2C+Karinkadamugal%2C+Thiruvananthapuram%2C+Kerala+695027!5e0!3m2!1sen!2sin!4v1549270335292"  allowfullscreen></iframe>
					</div> <!-- ./contactdiv -->
				</div> <!-- ./col-3 -->
			</div> <!-- ./inner-row -->
		</div> <!-- ./card-body -->
	</div> <!-- ./card -->
	</div> <!-- col12 -->
</div> <!-- ./row -->



<div class="row ">
	<div class="col-12 py-2">
		
	</div> <!-- col12 -->
</div> <!-- ./row -->
<div class="row ">
	<div class="col-12 py-2">
		
	</div> <!-- col12 -->
</div> <!-- ./row -->
<div class="row ">
	<div class="col-12 py-2">
		
	</div> <!-- col12 -->
</div> <!-- ./row -->
</div> <!-- ./container -->
<?php
include ('sectionfooter.php');
include ('jsfooter.php');
include ('scriptfooter.php');
include ('htmlfooter.php');
?>