<html>
	<head> 
		<link href="css/Gallery.css" type="text/css" rel="stylesheet">
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
	<div style="background-color: lightblue;">
		<h1 style="text-align:center;">Welcome To Winton's Gallery</h1>

			<div class="container">
				  <div class="mySlides">
					<div class="numbertext">1 / 6</div>
					<img src="Image/i5.webp" style="width:100%">
				  </div>

				  <div class="mySlides">
					<div class="numbertext">2 / 6</div>
					<img src="Image/i3.webp" style="width:100%">
				  </div>

				  <div class="mySlides">
					<div class="numbertext">3 / 6</div>
					<img src="Image/i1.jpg" style="width:100%">
				  </div>
				
				  <div class="mySlides">
					<div class="numbertext">4 / 6</div>
					<img src="Image/i2.jpg" style="width:100%">
				  </div>

				  <div class="mySlides">
					<div class="numbertext">5 / 6</div>
					<img src="Image/i3.jpg" style="width:100%">
				  </div>
				
				  <div class="mySlides">
					<div class="numbertext">6 / 6</div>
					<img src="Image/i6.jpg" style="width:100%">
				  </div>
			  
				  <a class="prev" onclick="plusSlides(-1)">❮</a>
				  <a class="next" onclick="plusSlides(1)">❯</a>

				  <div class="caption-container">
					<p id="caption"></p>
				  </div>

				  <div class="row">
						<div class="column">
						  <img class="demo cursor" src="Image/i5.webp" style="width:100%" onclick="currentSlide(1)" alt="Our Reception">
						</div>
						<div class="column">
						  <img class="demo cursor" src="Image/i3.webp" style="width:100%" onclick="currentSlide(2)" alt="Our Management Team">
						</div>
						<div class="column">
						  <img class="demo cursor" src="Image/i1.jpg" style="width:100%" onclick="currentSlide(3)" alt="Our Operation Theatre">
						</div>
						<div class="column">
						  <img class="demo cursor" src="Image/i2.jpg" style="width:100%" onclick="currentSlide(4)" alt="Our Laboratory">
						</div>
						<div class="column">
						  <img class="demo cursor" src="Image/i3.jpg" style="width:100%" onclick="currentSlide(5)" alt="Meeting Time">
						</div>   
						<div class="column">
						  <img class="demo cursor" src="Image/i6.jpg"style="width:100%" onclick="currentSlide(6)" alt="Our Consultants">
						</div> 
				  </div>
			 </div>
			  
<script>
		let slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
		  showSlides(slideIndex += n);
		}

		function currentSlide(n) {
		  showSlides(slideIndex = n);
		}

		function showSlides(n) {
		  let i;
		  let slides = document.getElementsByClassName("mySlides");
		  let dots = document.getElementsByClassName("demo");
		  let captionText = document.getElementById("caption");
		  if (n > slides.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = slides.length}
		  for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		  }
		  for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block";
		  dots[slideIndex-1].className += " active";
		  captionText.innerHTML = dots[slideIndex-1].alt;
		}
</script>
	</div>		
	</body>
</html>

