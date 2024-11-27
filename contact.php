<?php
include('header.php');
?>
<style>
.outer{
    background-image: url('assets/images/co.avif');  
    background-repeat:no-repeat;
    width: 100%;
    height: 220px;
    background-size: cover;
   }
    </style>
<section class="outer">
    <div class="container">
        <div class="row">
        <div class="col-md-4"></div>
          <div class="col-md-4 mt-5">
               <h1 class="fw-bold"> Get Started </h1> 
               <a href="log-in.php" class="ms-5 fw-bold">Log-in</a> /Contact
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <form>
            <div class="row mt-5">
                <div class="col-md-6">
                  <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Name:</label>
                        <input type="name" class="form-control" placeholder="Name" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" placeholder="E-mail" id="exampleInputPassword1">
                    </div>
                </div>
            </div>
       <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Subject:</label>
             <input type="text" class="form-control" placeholder="Enter subject here" id="exampleInputPassword1">
        </div>
            <div class=" form-label mb-3">
            <label >Message:</label>
       <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
            </div>
        
     <button type="submit" class="btn btn-success">Send Message</button>
    </form>
            </div>
            <div class="col-md-6 mt-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.89796514777!2d77.04416849523396!3d28.52755441146828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sNew%20Delhi%2C%20Delhi!5e0!3m2!1sen!2sin!4v1727782909192!5m2!1sen!2sin" width="600" height="450" style="border:0;" 
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
<section class="bg-success">
      <div class="container mt-4">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 text-center mt-5"> 
            <h1 class="fw-bold text-primary-emphasis">Subscribe Newsletter</h1>
            <p class="fs-6 text-white"> Lorem ipsum dolor sit amet consectetur 
              lo adipisicing elit. Impedit saepe facere.</p>
          </div>
          <div class="col-md-2"></div>
       </div>
     </div>
    <div class="container">
            <div class="row">
                 <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <form class="d-flex mt-3 pb-5" role="search">
                            <span><i class="fa-regular fa-envelope fa-2xl mt-4" style="color: #B197FC;"></i></span>
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-warning " type="submit">Subscribe</button>
                        </form>
                    </div>
                        <div class="col-md-4"></div>
                </div>
            </div>
    </section>
    <?php 
    include('footer.php');
    ?>