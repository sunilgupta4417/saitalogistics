@extends('frontend.layouts.master')
@section('page_content')
    <section id="where-from-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="where-from-design">
                        <h3 class="shipment-heading">Create New Shipment</h3>
                        <form id="signUpForm" action="{{ url('user/shipment/store') }}" method="POST">
                            {{ csrf_field() }}

                                <!-- Step7 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="payment-successful">
                                                <img src="{{asset('assets/images/successful.svg')}}" alt="" class="img-responsive">
                                                <h3>Payment Successful</h3>
                                                <p>Your shipment has been successfully added Track with your Waybill No. <b>3456789098</b></p>
                                            </div>
                                            <div class="payment-btns">
                                                <a href="#" class="down-btn">Download Invoice</a>
                                                <a href="{{ url('user/shipment/history') }}" class="done-btn">Done</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- start previous / next buttons -->
                                
                              <!-- end previous / next buttons -->
                            
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_body_scripts')
<script>
     $('.tab-link').click( function() {
     
     var tabID = $(this).attr('data-tab');
     
     $(this).addClass('active').siblings().removeClass('active');
     
     $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
     });
    </script>


    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab
            
            function showTab(n) {
              // This function will display the specified tab of the form...
              var x = document.getElementsByClassName("step");
              x[n].style.display = "block";
              //... and fix the Previous/Next buttons:
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
              } else {
                document.getElementById("nextBtn").innerHTML = "Continue";
              }
              //... and run a function that will display the correct step indicator:
              fixStepIndicator(n)
            }
            
            function nextPrev(n) {
              // This function will figure out which tab to display
              var x = document.getElementsByClassName("step");
              // Exit the function if any field in the current tab is invalid:
              if (n == 1 && !validateForm()) return false;
              // Hide the current tab:
              x[currentTab].style.display = "none";
              // Increase or decrease the current tab by 1:
              currentTab = currentTab + n;
              // if you have reached the end of the form...
              if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("signUpForm").submit();
                return false;
              }
              // Otherwise, display the correct tab:
              showTab(currentTab);
            }
            
            function validateForm() {
              // This function deals with validation of the form fields
              var x, y, i, valid = true;
              x = document.getElementsByClassName("step");
              y = x[currentTab].getElementsByTagName("input");
              // A loop that checks every input field in the current tab:
              for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false
                  valid = false;
                }
              }
              // If the valid status is true, mark the step as finished and valid:
              if (valid) {
                document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
              }
              return valid; // return the valid status
            }
            
            function fixStepIndicator(n) {
              // This function removes the "active" class of all steps...
              var i, x = document.getElementsByClassName("stepIndicator");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              //... and adds the "active" class on the current step:
              x[n].className += " active";
            }
    </script>

    <script type="text/javascript"> 
        function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
    </script>


@endsection
