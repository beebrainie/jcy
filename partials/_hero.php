 <!-- Travel Hero Section -->
 <section id="travel-hero" class="travel-hero section dark-background">

     <div class="hero-background">
         <video id="video1" class="hero-video active" autoplay muted loop>
             <source src="assets/img/angkorwat front.mp4" type="video/mp4">
         </video>
         <video id="video2" class="hero-video" autoplay muted loop>
             <source src="assets/img/angkor wat side.mp4" type="video/mp4">
         </video>
         <video id="video3" class="hero-video" autoplay muted loop>
             <source src="assets/img/mountain.mp4" type="video/mp4">
         </video>
         <video id="video3" class="hero-video" autoplay muted loop>
             <source src="assets/img/visiter angkorwat.mp4" type="video/mp4">
         </video>
         <video id="video3" class="hero-video" autoplay muted loop>
             <source src="assets/img/visiter angkorwat.mp4" type="video/mp4">
         </video>
         <video id="video3" class="hero-video" autoplay muted loop>
             <source src="assets/img/angkor wat side2.mp4" type="video/mp4">
         </video>
         <div class="hero-overlay">

         </div>
     </div>

     <script>
         const videos = document.querySelectorAll(".hero-video");
         let current = 0;

         function showNextVideo() {
             videos[current].classList.remove("active");
             current = (current + 1) % videos.length;
             videos[current].classList.add("active");
         }

         // Change video every 10 seconds (adjust as needed)
         setInterval(showNextVideo, 10000);
     </script>

     <div class="container position-relative">
         <div class="row align-items-center">
             <div class="col-lg-7">
                 <div class="hero-text" data-aos="fade-up" data-aos-delay="100">
                     <h1 class="hero-title">VISIT ANGKOR WAT <span style="color:#0f9dff ;">CHOOSE</span>
                         <span style="color: #ff9d00;">JCY!</span>
                     </h1>
                     <p class="hero-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                     <div class="hero-buttons">
                         <a href="#" class="btn btn-primary me-3">Start Exploring</a>
                         <a href="#" class="btn btn-outline">Browse Tours</a>
                     </div>
                 </div>
             </div>

             <div class="col-lg-5">
                 <div class="booking-form-wrapper" data-aos="fade-left" data-aos-delay="200">
                     <div class="booking-form">
                         <h3 class="form-title">Plan Your Adventure</h3>
                         <form action="" class="">
                             <div class="form-group mb-3">
                                 <label for="destination">Destination</label>
                                 <select name="destination" id="destination" class="form-select" required="">
                                     <option value="">Choose your destination</option>
                                     <option value="europe">Europe</option>
                                     <option value="asia">Asia</option>
                                     <option value="america">America</option>
                                     <option value="africa">Africa</option>
                                     <option value="oceania">Oceania</option>
                                 </select>
                             </div>

                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group mb-3">
                                         <label for="checkin">Departure Date</label>
                                         <input type="date" name="checkin" id="checkin" class="form-control" required="">
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group mb-3">
                                         <label for="checkout">Return Date</label>
                                         <input type="date" name="checkout" id="checkout" class="form-control" required="">
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group mb-3">
                                         <label for="adults">Adults</label>
                                         <select name="adults" id="adults" class="form-select" required="">
                                             <option value="1">1 Adult</option>
                                             <option value="2">2 Adults</option>
                                             <option value="3">3 Adults</option>
                                             <option value="4">4+ Adults</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group mb-3">
                                         <label for="children">Children</label>
                                         <select name="children" id="children" class="form-select">
                                             <option value="0">No Children</option>
                                             <option value="1">1 Child</option>
                                             <option value="2">2 Children</option>
                                             <option value="3">3+ Children</option>
                                         </select>
                                     </div>
                                 </div>
                             </div>

                             <div class="form-group mb-3">
                                 <label for="tour-type">Tour Type</label>
                                 <select name="tour_type" id="tour-type" class="form-select" required="">
                                     <option value="">Select tour type</option>
                                     <option value="adventure">Adventure</option>
                                     <option value="cultural">Cultural</option>
                                     <option value="relaxation">Relaxation</option>
                                     <option value="family">Family</option>
                                     <option value="luxury">Luxury</option>
                                 </select>
                             </div>

                             <button type="submit" class="btn btn-primary w-100">Find Your Perfect Trip</button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </section><!-- /Travel Hero Section -->

 <style>
     .booking-form input,
     .booking-form select,
     .booking-form .form-control,
     .booking-form .form-select {
         background-color: transparent !important;
         color: #fff !important;
         border: 1px solid rgba(255, 255, 255, 0.4);
         border-radius: 8px;
     }

     /* Ensure placeholder text is visible */
     .booking-form ::placeholder {
         color: rgba(255, 255, 255, 0.7);
     }

     /* Optional: Fix select arrow visibility */
     .booking-form select {
         -webkit-appearance: none;
         -moz-appearance: none;
         appearance: none;
         background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2210%22%20height%3D%225%22%20viewBox%3D%220%200%2010%205%22%20fill%3D%22white%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cpath%20d%3D%22M0%200L5%205L10%200H0Z%22/%3E%3C/svg%3E");
         background-repeat: no-repeat;
         background-position: right 1rem center;
         background-size: 10px 5px;
         padding-right: 2rem;
     }

     .booking-form select option {
         background-color: #fff;
         color: #000;
     }
 </style>