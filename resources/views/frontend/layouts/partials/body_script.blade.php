 <!-- Main jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Slick Slider -->
    <!-- Counterup -->
    <script src="{{ asset('assets/plugins/counterup/waypoint.js') }}"></script>
    <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/instafeed-js/instafeed.min.js') }}"></script>

    <!--  Magnific Popup-->
    <script src="{{ asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    
    <!-- Google Map -->
    <script src="{{ asset('assets/plugins/google-map/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&amp;callback=initMap"></script>    

    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script>
      //YOUTUBE VIDEO
         $('.play-button').click(function(e){
             var iframeEl = $('<iframe>', { src: $(this).data('url') });
             $('#youtubevideo').attr('src', $(this).data('url'));
         })

         $('#close-video').click(function(e){
             $('#youtubevideo').attr('src', '');
         }); 

         $(document).on('hidden.bs.modal','#myModal', function () {
             $('#youtubevideo').attr('src', '');
         }); 
    </script>
      <script>
         $('.tab-link').click( function() {
         
         var tabID = $(this).attr('data-tab');
         
         $(this).addClass('active').siblings().removeClass('active');
         
         $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
         });
      </script>


@yield('body_script')
