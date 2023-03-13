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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

         $(document).ready(function() {

$('#submit_btn').click(function(){

 let email = $('#email').val();
 let service_type = $("[name='service_type'] :selected").val();
 let shipper_country = $("[name='shipper_country'] :selected").val();
 let shipper_state = $("[name='shipper_state'] :selected").val();
 let recipient_postal = $('#recipient_postal').val();
 let shipper_postal = $('#shipper_postal').val();
 let width = $('#width').val();
 let height = $('#height').val();
 let length = $('#length').val();
 
 $.ajax({
   url: "{{route('shipping_rate')}}",
   type:"POST",
   data:{
     "_token": "{{ csrf_token() }}",
     email:email,
     service_type:service_type,
     shipper_country:shipper_country,
     shipper_state:shipper_state,
     recipient_postal:recipient_postal,
     shipper_postal:shipper_postal,
     width:width,
     length:length,
     height:height,
   },
   success:function(response){
     if(response.total_fedex_charge){
        $('#total_charges').text(response.total_fedex_charge+' USD')
        $('#fuel_sercharge').text(response.fuel_surcharge+' USD');
        $('#freight_sercharge').text(response.total_freight+' USD');
        $('#day_of_deli').text(response.DeliveryDayOfWeek);
        $('#deli_station').text(response.DeliveryStation);
        $('#serv_type').text(response.ServiceType);
        $('#tlt_bl_wight').text(response.TotalBillingWeightUnits);
     }else{
        $('#total_charges').text('Currently Service Unavailable')
     }
     
   },
   error: function(response) {
   },
   });
 });
 });
      </script>


@yield('body_script')
