
<html>
	<head>
	</head>
	<body>
		<div class="ccontainer">
			<div class = "left-slide">
				<div style="background-color:Brown;">
				 <h1>We have lot of options for you!</h1>
				 <p>Now,Choice Is Yours</p>
				</div>
				<div style="background-color:Green;">
				 <h1>Our Modern Operation Theatre</h1>
				 <p>Don't worry. We are ready with modern technologies</p>
				</div>
				<div style="background-color:Red;">
				 <h1>Management Meeting Time</h1>
				 <p>We are making every disicions about patient care with our Management</p>
				</div>
				<div style="background-color:rgb(47, 14, 156);">
				 <h1>We Are Best Medical Service Providers In Srilanka. Our Clinical Team</h1>
				 <p>Join With Winton For Healthy Life</p>
				</div>
			</div>
			<div class="right-slide">
				<div style="background-image:url('Image/I1.webp');"></div>
				<div style="background-image:url('Image/G2.webp');"></div>
				<div style="background-image:url('Image/s3.jpg');"></div>
				<div style="background-image:url('Image/s1.png');"></div>
			</div>
			<div class="action-buttons">
				<button class="down-button">
					<i class="fas fa-arrow-down"></i>
				</button>
				<button class="up-button">
					<i class="fas fa-arrow-up"></i>
				</button>
			</div>
		</div>
		
		
<script>
			const sliderccontainer = document.querySelector('.ccontainer');
			const slideRight	   = document.querySelector('.right-slide');
			const slideLeft 	   = document.querySelector('.left-slide');
			const upButton 		   = document.querySelector('.up-button');
			const downButton	   = document.querySelector('.down-button');
			const slidesLength = slideRight.querySelectorAll('div').length;
			let activeSlideIndex = 0;
			slideLeft.style.top = `-${(slidesLength - 1) * 80}vh` ;
			upButton.addEventListener("click", () => changeSlide('up')) ;
			downButton.addEventListener('click', () => changeSlide('down')) ;
			const changeSlide = (direction) => 
			{
				const sliderHeight = sliderccontainer.clientHeight ;
				if (direction === 'up')
				{
					activeSlideIndex++ 
					if (activeSlideIndex > slidesLength - 1) 
					{
						activeSlideIndex = 0 
					}
				} 
				else if(direction === 'down')
				{
					activeSlideIndex-- 
					if (activeSlideIndex < 0) 
					{
						activeSlideIndex = slidesLength - 1	;
					}
				}
				slideRight.style.transform = `translateY(-${activeSlideIndex * sliderHeight}px)`
				slideLeft.style.transform =  `translateY(${ activeSlideIndex * sliderHeight}px)`	
			}
</script>
<div style="background-color: lightblue;">
	<div class="bottom">
		<div>
			<table border="0">
				<tr>
					<td width="1000px">
					<font color="#000" size="5px"> Our strategic initiatives and corporate objectives are centered around creating value for our stakeholders in the short, medium and long term. <br><br>
						 We have structured our processes accordingly and our new guiding concept ‘You’ epitomises this.
						  While our focus is to be a leading healthcare provider, Durdans also ensures that its vision and performance is aligned with the need to be financially, socially and environmentally sustainable at all times. </font> 
					</td>
					<td style="padding-left:20px;"> <img src="image/team.jpg" width="400px"></td>
				</tr>	
			</table>
		</div>
	</div>
	</body>
</html>

