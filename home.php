<?php
// Database connection
include 'connection.php';

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form data
	$feed_name = $conn->real_escape_string($_POST['feed_name']);
	$feed_email = $conn->real_escape_string($_POST['feed_email']);
	$feedback = $conn->real_escape_string($_POST['feedback']);

	// Insert data into the database
	$sql = "INSERT INTO feedback (feed_name, feed_email, feedback) VALUES ('$feed_name', '$feed_email', '$feedback')";

	if ($conn->query($sql) === TRUE) {
		echo "";
	} else {
		echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
	}
}

$conn->close();
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<title>Archi - Free Architecture Portfolio HTML Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="TemplatesJungle">
	<meta name="keywords" content="Free HTML Template">
	<meta name="description" content="Free HTML Template">

	<link rel="stylesheet" type="text/css" href="suuu/icomoon.css">
	<link rel="stylesheet" type="text/css" href="suuu/vendor.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="suuu/style.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap"
		rel="stylesheet">
</head>

<body>

	<div class="preloader"></div>

	<div class="nav nav-overlay">
		<div class="nav__content">
			<div class="container">
				<div class="row p-4 p-md-0 flex-column-reverse flex-md-row g-md-5 nav__block">
					<div class="col-md-5">
						<ul class="nav__list d-none d-md-block">
							<li class="nav__list-item active-nav"><a href="index.html" class="hover-target">Home</a>
							</li>
							<li class="nav__list-item"><a href="cusgenre.php" class="hover-target">Genre</a></li>
							<li class="nav__list-item"><a href="cusbook.php" class="hover-target">Booking</a></li>
							 <li class="nav__list-item"><a href="TermsCon.php" class="hover-target">License</a></li>
							<li class="nav__list-item"><a href="cusreglog" class="hover-target">log out</a>
							</li>
							<!-- <li class="nav__list-item"><a href="contact.php" class="hover-target">Contact us</a></li>  -->
						</ul>
					</div>
					<div class="col-md-4 text-white">
						<h3 class="text-white fw-bold nav__block-item">Contact</h3>
						<p class="text-light nav__block-item">Ashirvad House” 52, Nathalal Colony, Opp. Ketan Society, Near Sardar Patel Colony, Navrangpura, Ahmedabad – 14, Gujarat, India.</p>
						<ul class="list-unstyled text-light nav__block-item">
							<li class="menu-item">
								<i class="icon icon-location me-2"></i>Mail: ashirvad.trust@gmail.com <br>
								Website: www.ashirvadfoundation.org
							</li>
							<li class="menu-item">
								<i class="icon icon-location2 me-2"></i>Navrangpura, Ahmedabad ,india
							</li>
							<li class="menu-item">
								<i class="icon icon-phone me-2">(079) 26464138 , 8155051451

							</li>

						</ul>
					</div>

				</div>
			</div>

		</div>
	</div>

	<div class="main-logo">
		<a href="index.html">A.</a>
	</div>

	<div class="side-nav-bar">
		<input id="menu-toggle" type="checkbox" />
		<label class="menu-btn" for="menu-toggle">
			<span></span>
		</label>
	</div>

	<section id="intro" class="scrollspy-section">
		<div class="main-slider">
			<div class="slider-item jarallax" data-speed="0.2">
				<video class="jarallax-img" autoplay muted loop>
					<source src="images/homevideo.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<div class="banner-content">
					<h2 class="banner-title"></h2>
					<div class="btn-wrap">
						<a href="#" class="btn-with-line"></a>
					</div>
				</div><!--banner-content-->
			</div><!--slider-item-->
		</div>
		<!-- <div class="slider-item jarallax" data-speed="0.2">
				<img src="images/ajagha.jpg" alt="banner" class="jarallax-img">
				<div class="banner-content">
					<h2 class="banner-title txt-fx">Clean & Minimal</h2>
					<div class="btn-wrap">
						<a href="#" class="btn-with-line"></a>
					</div>
				</div>
			</div>

			<div class="slider-item jarallax" data-speed="0.2">
				<img src="images/avesham.jpg"alt="banner" class="jarallax-img">
				<div class="banner-content">
					<h2 class="banner-title txt-fx">Personalize and Customize</h2>
					<div class="btn-wrap">
						<a href="#" class="btn-with-line"></a>
					</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="button-container">
			<button class="prev slick-arrow">
				<i class="icon icon-chevron-thin-left"></i>
			</button>
			<button class="next slick-arrow">
				<i class="icon icon-chevron-thin-right"></i>
			</button>
		</div>
	</section> -->

		<section id="about" class="scrollspy-section padding-xlarge">
			<div class="container">
				<div class="row">

					<div class="col-md-12">

						<div class="section-header">
							<div class="title">
								<span>who are we</span>
							</div>
							<h2 class="section-title">About Us</h2>
						</div>
					</div>

				</div>

				<div class="row">

					<div class="col-md-6">
						<figure class="jarallax-keep-img">
							<img src="images/avesham.jpg" alt="about us" class="jarallax-img single-image">
						</figure>
					</div>
					<div class="col-md-6 description text-lead">
						<p><strong>Our objective is to change dreams into reality by delivering content-rich films of the highest echelon coupled with the skills and zest to reach out to a global audience. Driven by a talented team of go-getters, Kreative Essence Motion Pictures aims to provide a vast range of services, ensuring that an idea that is sown in one corner of the brain gets transferred to the grandeur of the silver screen!
								With a strong emphasis on transparency and corporate ethics, Kreative Essence Motion Pictures works on various business models structured for best output. In fact, it is not only involved with all stages of pre-production, production & post production activities but it also acts as a facilitator for co- production ventures with international and national partners.</strong></p>
						<p>This fact has been confirmed by some recent small budget films, which have done exceptionally well at the Box Office. Kreative Essence Motion Pictures is in the process of creating such exceptional movies independently or in collaboration with talented independent film makers.</p>


						<div class="btn-wrap">
							<a href="cusgenre.php" class="btn btn-accent btn-xlarge btn-rounded">view generes</a>
						</div>

					</div>

				</div>

			</div>
		</section>

		<section id="portfolio" class="scrollspy-section bg-dark padding-large">
			<div class="container">

				<div class="row">
					<div class="col-md-12">

						<div class="section-header">
							<div class="title">
								<span>Some of Our Works</span>
							</div>
							<h2 class="section-title light">Our Portfolio</h2>
						</div>
					</div>
				</div>

				<div class="row">

					<div id="filters" class="button-group d-flex flex-wrap gap-4 py-5" data-aos="fade-up">
						<a href="#" class="btn btn-outline-light rounded-pill text-uppercase is-checked"
							data-filter=".design">2024</a>
						<a href="#" class="btn btn-outline-light rounded-pill text-uppercase"
							data-filter=".interior">coming soon</a>
						<a href="#" class="btn btn-outline-light rounded-pill text-uppercase"
							data-filter=".landscape">latest</a>
						<a href="#" class="btn btn-outline-light rounded-pill text-uppercase"
							data-filter=".construction">2025</a>
					</div>

				</div>

				<div class="grid p-0 clearfix row row-cols-2 row-cols-lg-3 row-cols-xl-3" data-aos="fade-up">
					<div class="col mb-4 portfolio-item construction interior">
						<a href="images/ajagha.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 1."><img src="images/095129208024019.Y3JvcCwzMDAwLDIzNDYsMCww.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item construction construction">
						<a href="images/arm.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 2."><img src="images/17971e142277161.Y3JvcCw1NDAwLDQyMjMsMCwyNDA.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item construction">
						<a href="images/c6e082206197937.66c834703c297.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 3."><img src="images/24202c201956749.Y3JvcCwxMDgwLDg0NCwwLDA.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item construction">
						<a href="images/b1570c193207829.Y3JvcCwyMzYyLDE4NDcsMCw1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 4."><img src="images/38b25a209514329.Y3JvcCwxNjAwLDEyNTEsMCw2Mjk.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item interior">
						<a href="images/manjumenl.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 5."><img src="images/45518d190852631.Y3JvcCwxMjgwLDEwMDEsMCw0NDY.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item design">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 6."><img src="images/aadujeevitham.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item design">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 7."><img src="images/ab19c6209724041.Y3JvcCwzMDAwLDIzNDYsMCw5ODc.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item design">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 8."><img src="images/ajagha.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item design">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 9."><img src="images/arm.jpg">
					</div>
					<div class="col mb-4 portfolio-item design">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item1 0."><img src="images/avesham.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item design">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item1 1."><img src="images/b1570c193207829.Y3JvcCwyMzYyLDE4NDcsMCw1.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item construction">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item1 2."><img src="images/b21563146145553.Y3JvcCwyMzYyLDE4NDcsMCww.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item interior">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 1."><img src="images/VAAZHA MOVIE POSTERS __ Behance_files/27fb53191521095.Y3JvcCwxMDgwLDg0NCwwLDIwMw.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item landscape">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 2."><img src="images/dd096a154994113.Y3JvcCwyMzYxLDE4NDcsMCww.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item landscape">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 3."><img src="images/manjumenl.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item interior">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 4."><img src="images/nunakuzhi.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item interior">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 5."><img src="images/premalu.png"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item interior">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 6."><img src="images/MANJUMMEL BOYS CONCEPT POSTER __ Behance_files/5d4436188666399.6657618a1437e.png"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item landscape">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 7."><img src="images/vaalibhan.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item landscape">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item 8."><img src="images/vaazha.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item landscape">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item1 0."><img src="images/vaalibhan.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item construction">
						<a href="images/portfolio-large-1.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item1 1."><img src="images/sundari.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
					<div class="col mb-4 portfolio-item landscape">
						<a href="images/portfolio-large-2.jpg" class="image-link"
							title="Sample Caption goes here for Portfolio Item1 2."><img src="images/DEVADOOTHAN-UNOFFICIAL POSTERS __ Behance_files/1ec239205024945(1).Y3JvcCw2MDM5LDQ3MjQsNDAzLDA.jpg"
								class="img-fluid" alt="portfolio"></a>
					</div>
				</div>

			</div>
		</section>

		<section id="services" class="scrollspy-section padding-large">
			<div class="container">
				<div class="row">
					<div class="section-header col-12">
						<div class="title">
							<span>what we do</span>
						</div>
						<h2 class="section-title">Services</h2>
					</div>

				</div>

				<div class="row">

					<div class="col-md-4">
						<div class="services-item">
							<span class="number">01</span>
							<h3>Movie distribution</h3>
							<p>Distributors license films to theaters granting the right to show the film for a theatrical rental rental fee.
							</p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="services-item">
							<span class="number">02</span>
							<h3>movie rights</h3>
							<p>the legal permissions granted to a person or entity to adapt a literary work, such as a book, into a film
							</p>
						</div>

					</div>

					<div class="col-md-4">
						<div class="services-item">
							<span class="number">03</span>
							<h3>satelliet</h3>
							<p>In the Indian movie industry, satellite rights refer to the permission granted by a movie producer to a television channel or network to air their film on TV
							</p>
						</div>
					</div>

				</div>

			</div>
		</section>

		<section id="subscribe" class="scrollspy-section padding-small">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<figure class="subscribe-image">
							<img src="images/VAAZHA MOVIE POSTERS __ Behance_files/6c19eb206197937.66c834703b16a.jpg" alt="subscribe">
						</figure>
					</div>
					<div class="col-md-6">
						<div class="subscribe-content">
							<h2 class="section-title">subscribe us</h2>
							<p>"Join our family and become a part of Aazad Film House! Subscribe today and dive into our world of creativity and storytelling. Get exclusive updates, early access to new releases, behind-the-scenes insights, and connect with like-minded film lovers. Be the first to know about our exciting projects, workshops, and events. Let’s make cinematic magic together—your journey with Aazad Film House starts here!"</p>
							<form id="form">
								<input type="text" name="email" placeholder="enter your email address">
								<button class="btn btn-accent btn-rounded btn-full btn-xlarge">Subscribe</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="latest-blog" class="scrollspy-section bg-grey padding-large">
			<div class="container">

				<div class="row">

					<div class="col">

						<div class="section-header">
							<div class="title">
								<span>read our blog</span>
							</div>
							<h2 class="section-title">latest blog</h2>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">

						<div class="post-grid">
							<div class="row">

								<div class="col-md-4">

									<article class="post-item">

										<figure>
											<a href="#" class="image-hvr-effect">
												<img src="images/yatra_pm010219_045.jpg" alt="post" class="post-image">
											</a>
										</figure>

										<div class="post-content">
											<div class="meta-date">apr 30, 2021</div>
											<h3 class="post-title"><a href="#">"Empowering Entertainment"</a></h3>
											<p>A movie rights house is the silent force behind every blockbuster on your screen, bridging the gap between creators and broadcasters. With expertise and a passion for cinema, they ensure that incredible stories reach audiences far and wide.</p>
										</div>
									</article>

								</div>

								<div class="col-md-4">

									<article class="post-item">
										<figure>
											<a href="#" class="image-hvr-effect">
												<img src="images/mohanlal220518_15.jpg" alt="post" class="post-image">
											</a>
										</figure>
										<div class="post-content">
											<div class="meta-date">Mar 29, 2022</div>
											<h3 class="post-title"><a href="#">"Your Gateway to Cinematic Masterpieces"</a></h3>
											<p>With an intuitive interface and a commitment to supporting the industry, a movie rights platform brings the world of cinema closer to those who wish to showcase it. It's not just about licensing—it's about preserving and promoting the art of film for audiences everywhere."</p>
										</div>
									</article>
								</div>

								<div class="col-md-4">
									<article class="post-item">
										<figure>
											<a href="#" class="image-hvr-effect">
												<img src="images/prithviraj_latest_stills_5.jpg" alt="post" class="post-image">
											</a>
										</figure>
										<div class="post-content">
											<div class="meta-date">feb 27, 2018</div>
											<h3 class="post-title"><a href="#">"Where Stories Find Their Screen"</a></h3>
											<p>it’s where stories find their perfect screen. By streamlining the acquisition process, these platforms bring remarkable films to the forefront, giving broadcasters and channels a chance to connect with diverse and powerful content With a dedication to simplicity.</p>
										</div>
									</article>
								</div>

							</div>
						</div>

					</div>



				</div>

				<div class="row">
					<div class="col">

						<div class="btn-wrap align-center">
							<a href="#" class="btn btn-xlarge btn-accent btn-rounded">View all blog</a>
						</div>

					</div>
				</div>

			</div>
		</section>

		<section id="contact" class="scrollspy-section bg-dark padding-large">
			<div class="container">

				<div class="row">
					<div class="col-md-6">

						<div class="left-content">

							<div class="section-header">
								<div class="title">
									<span>Get in touch</span>
								</div>
								<h2 class="section-title light">Contact us</h2>
							</div>

							<p>If you have any question about our process or company? Let us know how we can help you.</p>

							<form id="form-contact" class="form-light" action="contact.php" method="POST">
								<p>
									<input type="text"
										name="name"
										placeholder="Your Full Name*"
										required
										pattern="[A-Za-z\s]+"
										title="Name can only contain letters and spaces">
								</p>
								<p>
									<input type="email"
										name="email"
										placeholder="Your Email Address"
										required
										pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
										title="Please enter a valid email address">
								</p>
								<p>
									<textarea name="message"
										placeholder="Your Message"
										required
										minlength="10"
										maxlength="500"
										title="Message must be between 10 and 500 characters"></textarea>
								</p>
								<p>
									<label for="agree">
										<input id="agree"
											name="agree"
											type="checkbox"
											required>
										<span>I agree to the privacy policy</span>
									</label>
								</p>
								<button class="btn btn-accent btn-rounded btn-xlarge btn-full">Submit</button>
							</form>



						</div>

					</div><!--left-content-->

					<div class="col-md-6">
						<div class="right-content">

							<div class="iconbox">
								<i class="icon icon-location"></i>
								<div class="detail">
									<strong>Address 1:</strong>
									<p>Ashirvad House” 52, Nathalal Colony, Opp. Ketan Society, Near Sardar Patel Colony, Navrangpura, Ahmedabad – 14, Gujarat, India.</p>
								</div>
							</div>
							<div class="iconbox">
								<i class="icon icon-location2"></i>
								<div class="detail">
									<strong>Address 2:</strong>
									<p>Navrangpura, Ahmedabad ,india</p>
								</div>
							</div>
							<div class="iconbox">
								<i class="icon icon-phone"></i>
								<div class="detail">
									<strong>Phone:</strong>
									<p>+63 667 341 3463</p>
								</div>
							</div>
							<div class="iconbox">
								<i class="icon icon-mail3"></i>
								<div class="detail">
									<strong>Email:</strong>
									<p><a href="#">ashirvad.trust@gmail.com </a></p>
								</div>
							</div>

						</div>
					</div><!--right-content-->

				</div>

			</div>
		</section>

		<section id="testimonial" class="padding-large">
			<div class="container">

				<div class="row">

					<div class="col-md-6">

						<figure class="jarallax-keep-img testimonial-image" data-speed="0.5">
							<img src="images/DEVADOOTHAN-UNOFFICIAL POSTERS __ Behance_files/64dbdd197530111.Y3JvcCwxNDAwLDEwOTUsMCwyNjY.png" alt="review" class="jarallax-img">
						</figure>

					</div>

					<div class="col-md-6">

						<div class="testimonial-block">
							<div class="section-header">
								<div class="title">
									<span>What clients says</span>
								</div>
								<h2 class="section-title">Testimonials</h2>
							</div>
							<div class="testimonials-inner">
								<q>"An invaluable resource!" "Partnering with this platform has completely transformed our content acquisition process. The site is user-friendly, and the selection is impressive. We’ve found incredible films that truly resonate with our audience!" <br>
									— James C., Programming Director</q>
								<q>"A game-changer for our network!" "Finding diverse and compelling content used to be a challenge, but this movie rights site changed that. The ease of use, the support, and the quality of films available have all exceeded our expectations."<br>
									— Anna L., Content Manager</q>
							</div>
						</div>
					</div><!--reviews-content-->

				</div>
			</div><!--grid-->

			</div>
		</section>

		<footer id="footer">
			<div class="container">
				<div class="row">

					<div class="col-md-3">

						<div class="footer-menu menu-item-01">
							<<div class="main-logo">
								<a href="index.html">A.</a>
						</div>

						<div class="social-links">
							<ul>
								<li>
									<a href="#"><i class="icon icon-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-youtube-play"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-behance-square"></i></a>
								</li>
							</ul>
						</div>
					</div>

				</div>

				<div class="col-md-2">

					<div class="footer-menu menu-item-02">
						<h5>quick links</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="home.php">home</a>
							</li>
							<li class="menu-item">
								<a href="cusgenre.php">genre</a>
							</li>
							<li class="menu-item">
								<a href="cusbook.php">booking</a>
							</li>
							<!-- <li class="menu-item">
								<a href="#">portfolios</a>
							</li>
							<li class="menu-item">
								<a href="#">blogs</a>
							</li>
							<li class="menu-item">
								<a href="#">contact us</a>
							</li> -->
						</ul>
					</div>

				</div>

				<div class="col-md-4">

					<div class="footer-menu menu-item-03">
						<h5>contact info</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<i class="icon icon-location"></i>2489 Locust Court, Los Angeles
							</li>
							<li class="menu-item">
								<i class="icon icon-location2"></i>Navrangpura, Ahmedabad ,india
							</li>
							<li class="menu-item">
								<i class="icon icon-phone"></i>+63 667 341 3463
							</li>
							<li class="menu-item">
								<i class="icon icon-envelope-o"></i><a href="#" class="mail-id">ashirvad@gmail.com</a>
							</li>
						</ul>
					</div>

				</div>

				<div class="col-md-3">

					<div class="footer-menu menu-item-04">
						<h5>gallery</h5>
						<div class="gallery">
							<a href="images/ajagha.jpg" data-lightbox-gallery="gallery1"
								title="Calm Before The Storm (One Shoe Photography Ltd.)" class="image-link"><img
									src="images/ajagha.jpg" alt="house" class="gallery-image"></a>
							<a href="images/arm.jpg" data-lightbox-gallery="gallery1"
								title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))" class="image-link"><img
									src="images/arm.jpg" alt="house" class="gallery-image"></a>
							<a href="images/DEVADOOTHAN-UNOFFICIAL POSTERS __ Behance_files/2d94ec166421155.Y3JvcCwxNzEyLDEzMzksMCwxNjU.jpg" data-lightbox-gallery="gallery1"
								title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))" class="image-link"><img
									src="images/DEVADOOTHAN-UNOFFICIAL POSTERS __ Behance_files/2d94ec166421155.Y3JvcCwxNzEyLDEzMzksMCwxNjU.jpg" alt="house" class="gallery-image"></a>
							<a href="images/b21563146145553.Y3JvcCwyMzYyLDE4NDcsMCww.jpg" data-lightbox-gallery="gallery1"
								title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))" class="image-link"><img
									src="images/b21563146145553.Y3JvcCwyMzYyLDE4NDcsMCww.jpg" alt="house" class="gallery-image"></a>
							<a href="images/VAAZHA MOVIE POSTERS __ Behance_files/27fb53191521095.Y3JvcCwxMDgwLDg0NCwwLDIwMw.jpg" data-lightbox-gallery="gallery1"
								title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))" class="image-link"><img
									src="images/VAAZHA MOVIE POSTERS __ Behance_files/27fb53191521095.Y3JvcCwxMDgwLDg0NCwwLDIwMw.jpg" alt="house" class="gallery-image"></a>
							<a href="images/vaalibhan.jpg" data-lightbox-gallery="gallery1"
								title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))" class="image-link"><img
									src="images/vaalibhan.jpg" alt="house" class="gallery-image"></a>
						</div>
					</div>

				</div>

			</div>
			</div>
		</footer>

		<div id="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="copyright">
							<p>© 2022 Archi. All rights reserved.</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="copyright text-right">
							<p>HTML Template by <a href="https://www.templatesjungle.com/"
									target="_blank">TemplatesJungle</a> distributed By <a href="https://themewagon.com" target="blank">ThemeWagon</a> </p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="suuu/jquery-1.11.0.min.js"></script>
		<script src="suuu/ui-easing.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
			crossorigin="anonymous"></script>
		<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
		<script src="suuu/plugins.js"></script>
		<script src="suuu/script.js"></script>

</body>

</html>