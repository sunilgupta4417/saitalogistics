@extends('frontend.layouts.master')
@section('page_content')


<!--========================= Transactions History Start Here ======================== -->
<section class="section pricing" id="make-shipping">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-12">
            <div class="heading text-center">
               <h2 class="mb-3">Transactions</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-lg-812">
            <div class="shipment-history">
               <div class="transactions-table">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Order ID</th>
                           <th>Date</th>
                           <th>Amount</th>
                           <th>Gateway</th>
                           <th>Tokens</th>
                           <th>Status</th>
                           <th>View</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>202303050547057000000000</td>
                           <td>2023-03-05T05:47:00.000Z</td>
                           <td>200.00</td>
                           <td>PayBaba</td>
                           <td>57142.85714</td>
                           <td><b>Pending</b></td>
                           <td class="view-btn"> <a href="view-transactions.html">View Details</a></td>
                        </tr>
                        <tr>
                           <td>202303050547057000000000</td>
                           <td>2023-03-05T05:47:00.000Z</td>
                           <td>200.00</td>
                           <td>PayBaba</td>
                           <td>57142.85714</td>
                           <td><b>Pending</b></td>
                           <td class="view-btn"> <a href="view-transactions.html">View Details</a></td>
                        </tr>
                     </tbody>
                  </table>

               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--========================= Transactions History End Here ======================== -->

<section class="footer">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-3">
            <div class="widget footer-widget mb-5 mb-lg-0">
               <img src="assets/images/logo-dark.png" alt="Digicon" class="img-fluid">
               <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
         </div>
         <div class="col-lg-2 col-md-2">
         </div>
         <div class="col-lg-3 col-md-3">
            <div class="widget footer-widget mb-5 mb-lg-0">
               <ul class="list-unstyled footer-links">
                  <li><a href="about-us.html">About us</a></li>
                  <li><a href="services.html">Services</a></li>
                  <li><a href="shipping.html">Shipping</a></li>
                  <li><a href="tracking.html">Tracking</a></li>
                  <li><a href="support.html">Support</a></li>
               </ul>
            </div>
         </div>
         <div class="col-lg-1 col-md-1">
         </div>
         <div class="col-lg-3 col-md-3">
            <div class="widget footer-widget mb-5 mb-lg-0">
               <ul class="list-unstyled footer-links">
                  <li><a href="support.html">Support</a></li>
                  <li><a href="faq's.html">FAQ's</a></li>
                  <li><a href="terms-and-condition.html">Terms & Condition</a></li>
                  <li><a href="privacy-policy.html">Privacy Policy</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="footer-btm">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-8">
            <div class="copyright">
               <p>Copyright © 2023 saith logistics. All rights reserved</p>
            </div>
         </div>
         <div class="col-lg-6 col-md-4">
            <ul class="list-inline footer-socials text-lg-right mb-0">
               <li class="list-inline-item">
                  <a href="#"><img src="assets/images/social-icon/facebook.svg" alt="" class="img-responsive"></a>
               </li>
               <li class="list-inline-item">
                  <a href="#"><img src="assets/images/social-icon/twitter.svg" alt="" class="img-responsive"></a>
               </li>
               <li class="list-inline-item">
                  <a href="#"><img src="assets/images/social-icon/instagram.svg" alt="" class="img-responsive"></a>
               </li>
               <li class="list-inline-item">
                  <a href="#"><img src="assets/images/social-icon/globe.svg" alt="" class="img-responsive"></a>
               </li>
               <li class="list-inline-item">
                  <a href="#"><img src="assets/images/social-icon/be.svg" alt="" class="img-responsive"></a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!--================ Essential Scripts =================-->
<!-- Main jQuery -->
<script src="assets/plugins/jquery/jquery.js"></script>
<!-- Bootstrap 3.1 -->
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Slick Slider -->
<!-- Counterup -->
<script src="assets/plugins/counterup/waypoint.js"></script>
<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
<script src="assets/plugins/instafeed-js/instafeed.min.js"></script>

<!-- Scrolltopcontrol js-->
<script src="assets/js/scrolltopcontrol.js"></script>
<script src="assets/js/script.js"></script>

<script>
   //YOUTUBE VIDEO
   $('.play-button').click(function(e) {
      var iframeEl = $('<iframe>', {
         src: $(this).data('url')
      });
      $('#youtubevideo').attr('src', $(this).data('url'));
   })

   $('#close-video').click(function(e) {
      $('#youtubevideo').attr('src', '');
   });

   $(document).on('hidden.bs.modal', '#myModal', function() {
      $('#youtubevideo').attr('src', '');
   });
</script>
<script>
   $('.tab-link').click(function() {

      var tabID = $(this).attr('data-tab');

      $(this).addClass('active').siblings().removeClass('active');

      $('#tab-' + tabID).addClass('active').siblings().removeClass('active');
   });
</script>

@endsection