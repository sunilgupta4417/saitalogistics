<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('input').keyup(function(){
        getReviewFormData();
    });
    function checkInputFieldKeys(inputName="",identifier=""){
        if(inputName){
            if(!identifier){
                identifier=inputName;
            }
            if($("input[name="+inputName+"]").length>0){
                return $("input[name="+inputName+"]").val();
            }else{
                $('#'+identifier).hide();
                return false;
            }
        }
    }
    function checkSelectFieldKeys(selectName="",identifier="",type="value"){
        if(selectName){
            if(!identifier){
                identifier=selectName;
            }
            if($("select[name="+selectName+"] option:selected").length>0){
                if(type=='value'){
                    return $("select[name="+selectName+"] option:selected").val();
                }else{
                    return $("select[name="+selectName+"] option:selected").text();
                }
            }else{
                $('#'+identifier).hide();
                return false;
            }
        }
    }

    function getReviewFormData(){
        if(checkInputFieldKeys("csr_consignor","from_company_name")){
            $('#from_company_name').html(checkInputFieldKeys("csr_consignor"));
        }
        if(checkInputFieldKeys("csr_consignor_person","from_name")){
            $('#from_name').html(checkInputFieldKeys("csr_consignor"));
        }
        //Address
        var csr_address1="";
        if(checkInputFieldKeys("csr_address1")){
            csr_address1=checkInputFieldKeys("csr_address1");
        }
        var csr_address2="";
        if(checkInputFieldKeys("csr_address2")){
            csr_address2=checkInputFieldKeys("csr_address2");
        }
        var csr_address3="";
        if(checkInputFieldKeys("csr_address3")){
            csr_address3=checkInputFieldKeys("csr_address3");
        }
        var csr_pincode="";
        if(checkInputFieldKeys("csr_pincode")){
            csr_pincode=checkInputFieldKeys("csr_pincode");
        }
        var csr_city_id="";
        if(checkInputFieldKeys("csr_city_id")){
            csr_city_id=checkInputFieldKeys("csr_city_id");
        }
        var csr_state_id="";
        if(checkInputFieldKeys("csr_state_id")){
            csr_state_id=checkInputFieldKeys("csr_state_id");
        }
        var S_other="";
        if(checkInputFieldKeys("S_other")){
            S_other=checkInputFieldKeys("S_other");
        }
        var csr_country_id="";
        if(checkSelectFieldKeys("csr_country_id")){
            csr_country_id=checkSelectFieldKeys("csr_country_id","csr_country_id",'text');
        }
        var csr_pincode="";
        if(checkInputFieldKeys("csr_pincode")){
            csr_pincode=checkInputFieldKeys("csr_pincode");
        }
        $('#from_address').html(csr_address1+' , '+csr_address2+' , '+csr_address3+' , '+csr_city_id+' , '+csr_state_id+' , '+S_other+' , '+csr_country_id+" - "+csr_pincode);
        //From Number
        var csr_contact_person_code="";
        if(checkSelectFieldKeys("csr_contact_person_code")){
            csr_contact_person_code=checkSelectFieldKeys("csr_contact_person_code");
        }
        var csr_contact_person="";
        if(checkInputFieldKeys("csr_contact_person")){
            csr_contact_person=checkInputFieldKeys("csr_contact_person");
        }
        $('#from_number').html(csr_contact_person_code+csr_contact_person);
        //from_phone_number
        var csr_mobile_code="";
        if(checkSelectFieldKeys("csr_mobile_code")){
            csr_mobile_code=checkSelectFieldKeys("csr_mobile_code");
        }
        var csr_mobile_no="";
        if(checkInputFieldKeys("csr_mobile_no")){
            csr_mobile_no=checkInputFieldKeys("csr_mobile_no");
        }
       // $('#from_phone_number').html("Telephone: "+csr_mobile_code+csr_mobile_no);
        if(checkInputFieldKeys("csr_pan","from_pan_no")){
           $('#from_pan_no').html("Business Registration Number: "+checkInputFieldKeys("csr_pan"));
        }
        if(checkInputFieldKeys("csr_gstin","from_gstin")){
            $('#from_gstin').html("VAT: "+checkInputFieldKeys("csr_gstin"));
        }
        if(checkInputFieldKeys("csr_iec","from_iec")){
            $('#from_iec').html("IEC (Import and Export Code): "+checkInputFieldKeys("csr_iec"));
        }
        if(checkInputFieldKeys("csr_aadharno","from_adhaar_no")){
            $('#from_adhaar_no').html("Individual ID: "+checkInputFieldKeys("csr_aadharno"));
        }
        if(checkInputFieldKeys("csr_address1_type","from_address_type")){
            $('#from_address_type').html("Address Type: "+checkInputFieldKeys("csr_address1_type"));
        }
        if(checkInputFieldKeys("csr_email_id","from_email")){
            $('#from_email').html("Email: "+checkInputFieldKeys("csr_email_id"));
        }
        if(checkSelectFieldKeys("S_idProof","from_kyc_document")){
            $('#from_kyc_document').html("KYC Doc: "+checkSelectFieldKeys("S_idProof"));
        }
        if(checkInputFieldKeys("csr_consignor","pickup_from_company_name")){
            $('#pickup_from_company_name').html(checkInputFieldKeys("csr_consignor"));
        }
        if(checkInputFieldKeys("csr_consignor","pickup_from_name")){
            $('#pickup_from_name').html(checkInputFieldKeys("csr_consignor"));
        }
        $('#pickup_from_address').html(csr_address1+' , '+csr_address2+' , '+csr_address3+' , '+csr_city_id+' , '+csr_state_id+' , '+S_other+' , '+csr_country_id+" - "+csr_pincode);
        $('#pickup_from_number').html(csr_contact_person_code+csr_contact_person);
        if(checkInputFieldKeys("csn_consignor","to_name")){
            $('#to_company_name').html(checkInputFieldKeys("csn_consignor"));
        }
        if(checkInputFieldKeys("csn_consignor_person","to_name")){
            $('#to_name').html(checkInputFieldKeys("csn_consignor_person"));
        }
                
        //To Address
        var csn_address1="";
        if(checkInputFieldKeys("csn_address1")){
            csn_address1=checkInputFieldKeys("csn_address1");
        }
        var csn_address2="";
        if(checkInputFieldKeys("csn_address2")){
            csn_address2=checkInputFieldKeys("csn_address2");
        }
        var csn_address3="";
        if(checkInputFieldKeys("csn_address3")){
            csn_address3=checkInputFieldKeys("csn_address3");
        }
        var csn_pincode="";
        if(checkInputFieldKeys("csn_pincode")){
            csn_pincode=checkInputFieldKeys("csn_pincode");
        }
        var csn_city_id="";
        if(checkInputFieldKeys("csn_city_id")){
            csn_city_id=checkInputFieldKeys("csn_city_id");
        }
        var csn_state_id="";
        if(checkInputFieldKeys("csn_state_id")){
            csn_state_id=checkInputFieldKeys("csn_state_id");
        }
        var R_other="";
        if(checkInputFieldKeys("R_other")){
            R_other=checkInputFieldKeys("R_other");
        }
        var csn_country_id="";
        if(checkSelectFieldKeys("csn_country_id")){
            csn_country_id=checkSelectFieldKeys("csn_country_id");
        }
        var csn_pincode="";
        if(checkInputFieldKeys("csn_pincode")){
            csn_pincode=checkInputFieldKeys("csn_pincode");
        }
        $('#to_address').html(csn_address1+' , '+csn_address2+' , '+csn_address3+' , '+csn_city_id+' , '+csn_state_id+' , '+R_other+' , '+csn_country_id+" - "+csn_pincode);
        //to Number
        var csn_contact_person_code="";
        if(checkSelectFieldKeys("csn_contact_person_code")){
            csn_contact_person_code=checkSelectFieldKeys("csn_contact_person_code");
        }
        var csn_contact_person="";
        if(checkInputFieldKeys("csn_contact_person")){
            csn_contact_person=checkInputFieldKeys("csn_contact_person");
        }
        $('#to_number').html(csn_contact_person_code+csn_contact_person);
        //to_phone_number
        var csn_mobile_code="";
         if(checkSelectFieldKeys("csn_mobile_code")){
             csn_mobile_code=checkSelectFieldKeys("csn_mobile_code");
        }
        var csn_mobile_no="";
        if(checkInputFieldKeys("csn_mobile_no")){
            csn_mobile_no=checkInputFieldKeys("csn_mobile_no");
        }
        $('#to_phone_number').html("Telephone: "+csn_mobile_code+csn_mobile_no);
        if(checkInputFieldKeys("csn_email_id","to_email")){
            $('#to_email').html("Email: "+checkInputFieldKeys("csn_email_id"));
        }
        if(checkInputFieldKeys("csn_iec_number","csn_iec_number")){
            $('#csn_iec_number').html("IEC: "+checkInputFieldKeys("csn_iec_number"));
        }
        if(checkInputFieldKeys("csn_tan_number","to_tan_no")){
            $('#to_tan_no').html("VAT No: "+checkInputFieldKeys("csn_tan_number"));
        }
        if(checkInputFieldKeys("csn_bn_number","csn_bn_number")){
            $('#csn_bn_number').html("BN No: "+checkInputFieldKeys("csn_bn_number"));
        }
        if(checkInputFieldKeys("pcs_weight")){
            $('#pcs_weight .value').html(checkInputFieldKeys("pcs_weight") + " KG");
        }
        if(checkInputFieldKeys("width") || checkInputFieldKeys("height") || checkInputFieldKeys("length")){
            $('#dimensions .value').html(checkInputFieldKeys("width")+' X '+checkInputFieldKeys("height")+' X '+checkInputFieldKeys("length")+ ' CM');
        }else{
            $('#dimensions').hide();
        }
        
        if(checkSelectFieldKeys("container_type","container_type")){
            $('#container_type .value').html(checkSelectFieldKeys("container_type"));
        }
        if(checkInputFieldKeys("commodity","commodity")){
            $('#commodity .value').html(checkInputFieldKeys("commodity"));
        }
        if(checkSelectFieldKeys("commodity_type","commodity_type")){
            $('#commodity_type .value').html(checkSelectFieldKeys("commodity_type"));
        }
        
        if(checkInputFieldKeys("chargeable_weight","total_shipment_weight")){
            $('#total_shipment_weight .value').html(checkInputFieldKeys("chargeable_weight") + " KG");
        }
        if(checkInputFieldKeys("no_of_package","no_of_package")){
            $('#no_of_package .value').html(checkInputFieldKeys("no_of_package"));
        }
        if(checkInputFieldKeys("shipping_charge","shippingCharge")){
            $('#shippingCharge .value').html(checkInputFieldKeys("shipping_charge"));
        }
        $('#ship_type').html($("input[name=cpickup]:checked").val());
        if(checkInputFieldKeys("booking_date","shipment_date")){
            $('#shipment_date').html(checkInputFieldKeys("booking_date"));
        }
        if(checkSelectFieldKeys("packet_type","packetType")){
            $('#packetType  .value').html(checkSelectFieldKeys("packet_type"));
        }
        if(checkInputFieldKeys("shipping_charge","shippingCharge")){
            $('#shippingCharge').html(checkInputFieldKeys("shipping_charge"));
        }
        if(checkInputFieldKeys("dvalue","declaredvalue")){
            $('#declaredvalue .value').html(checkInputFieldKeys("dvalue"));
        }
    }
    $('.tab-link').click( function() {
        var tabID = $(this).attr('data-tab'); 
        $(this).addClass('active').siblings().removeClass('active');
        $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
    });
    $('#get-rates').click(function(){
        getRates();
    });
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
            
    function showTab(n) {
        getReviewFormData();
        if (n == 3) {
            // $('#nextBtn').prop('disabled', true);
        }else if (n == 5) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{route("user.store_new_shipment")}}',
                data:  new FormData($('#signUpForm')[0]),
                contentType: false,
                cache: false,
                processData:false,
                success: function (res) {
                    $(".payment-successful b.successOrderNumber").html(res.id);
                    console.log(res);
                    setTimeout(function(){
                        moveFormSteps(n);
                    },2000);
                    $(".form-footer button#prevBtn").remove();
                    $(".form-footer button#nextBtn").hide();
                },
                error: function (res) {
                    console.log(res)
                    $(".form-footer button#prevBtn").trigger('click');
                }
            });              
        } else {
            $('#nextBtn').prop('disabled', false);
        }
        //... and run a function that will display the correct step indicator:
        if (n != 5) {
            moveFormSteps(n);
        }
    }
    function moveFormSteps(n){
        console.log(n);
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("step");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        var prevBtn = document.getElementById("prevBtn");
        var nextBtn = document.getElementById("nextBtn");
        if (n == 0) {
            if(prevBtn) {
                prevBtn.style.display = "none";
            }
        } else {
            if(prevBtn) {
                prevBtn.style.display = "inline";
            }
        }
        if (n == (x.length - 2)) {
            if(nextBtn) {
                nextBtn.innerHTML = "Submit";
            }
        } else {
            if(nextBtn) {
                nextBtn.innerHTML = "Continue";
            }
        } 
        fixStepIndicator(n);
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
        showTab(currentTab);
    }
            
    function getRates() {
        $('#nextBtn').html('Loading');
        package_type = $("select[name=package_type]").find(":selected").val();
        csn_country_id = $("select[name=csn_country_id]").find(":selected").val();
        csr_country_id=$("select[name=csr_country_id] option:selected").val();
        grossWeight = $("input[name=pcs_weight]").val();
        length = $("input[name=length]").val();
        width = $("input[name=width]").val();
        height = $("input[name=height]").val();
        if (grossWeight == "" || length == "" || width == "" || height == "") {
            alert('Please fill all field');
            return false;
        }
        const chargeableWeight = (length * width * height) / 5000;
        var pcs_weight=chargeableWeight;
        if(grossWeight>chargeableWeight){
            pcs_weight=grossWeight;
        }
        console.log(pcs_weight);
        $('#chargeableWeight').val(pcs_weight);
        $('#actual_weight').val(pcs_weight);
        $('#nextBtn').html("Continue");
    }
    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("step");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        const notRequired = ['csr_address3','S_other', 'S_pan', 'csr_gstin', 'csr_iec', 'S_aadhaar', 'csn_address3', 'R_other','csn_tan_number'];
        for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == ""  && !notRequired.includes(y[i].name)) {
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
    document.getElementById('div1').style.display ='none';
    function show1(){
        document.getElementById('div1').style.display ='none';
    }
    function show2(){
        document.getElementById('div1').style.display = 'block';
    }
    $("form").on("change", ".file-upload-field", function(){ 
        $(this).parent(".file-upload-wrapper").attr("data-text",$(this).val().replace(/.*(\/|\\)/, '') );
    });

    $('.edit_frm_ad_btn').click(function() {
        $('input[name=csr_address1]').val($('input[name=csr_address1]').val())
        $('input[name=csr_address2]').val($('input[name=csr_address2]').val())
        $('input[name=csr_address3]').val($('input[name=csr_address3]').val())
        $('input[name=csr_pincode]').val($('input[name=csr_address3]').val())
        $('input[name=csr_city_id]').val($('input[name=csr_city_id]').val())
        $('input[name=csr_state_id]').val($('input[name=csr_state_id]').val())
        $('input[name=S_other]').val($('input[name=S_other]').val())

        $('#update_from_address_modal').modal('show');
    });

    $('.edit_go_ad_btn').click(function() {
        $('input[name=edit_R_address]').val($('input[name=csn_address1]').val())
        $('input[name=edit_R_appartment]').val($('input[name=csn_address2]').val())
        $('input[name=edit_R_department]').val($('input[name=csn_address3]').val())
        $('input[name=edit_R_pincode]').val($('input[name=csn_pincode]').val())
        $('input[name=edit_R_city]').val($('input[name=csn_city_id]').val())
        $('input[name=edit_R_state]').val($('input[name=csn_state_id]').val())
        $('input[name=edit_R_other]').val($('input[name=R_other]').val())

        $('#update_going_address_modal').modal('show');
    });

    $("#udt_frm_add").click(function(){
        var popForm=$(this).parents("#update_from_address_modal");
        $('input[name=csr_address1]').val(popForm.find('input[name=csr_address1]').val())
        $('input[name=csr_address2]').val(popForm.find('input[name=csr_address2]').val())
        $('input[name=csr_address3]').val($popForm.find('input[name=csr_address3]').val())
        $('input[name=csr_pincode]').val(popForm.find('input[name=csr_pincode]').val())
        $('input[name=csr_city_id]').val(popForm.find('input[name=csr_city_id]').val())
        $('input[name=csr_state_id]').val(popForm.find('input[name=csr_state_id]').val())
        $('input[name=S_other]').val(popForm.find('input[name=S_other]').val())
        //$('#from_name').html($("input[name=csr_consignor]").val());
        $('#from_address').html($('input[name=csr_address1]').val()+' , '+$('input[name=csr_address2]').val()+' , '+$('input[name=csr_address3]').val()+' , '+$('input[name=csr_pincode]').val()+' , '+$('input[name=csr_city_id]').val()+' , '+$('input[name=csr_state_id]').val()+' , '+$('input[name=S_other]').val());
        //$('#from_number').html($("input[name=csr_contact_person]").val());
        $('#pickup_from_name').html($("input[name=csr_consignor]").val());
        $('#pickup_from_address').html($('input[name=csr_address1]').val()+' , '+$('input[name=csr_address2]').val()+' , '+$('input[name=csr_address3]').val()+' , '+$('input[name=csr_pincode]').val()+' , '+$('input[name=csr_city_id]').val()+' , '+$('input[name=csr_state_id]').val()+' , '+$("select[name='csr_country_id'] option:selected").text()+' , '+$('input[name=S_other]').val());
        //$('#pickup_from_number').html($("input[name=csr_contact_person]").val());
        $('#update_from_address_modal').modal('hide');
    });

    $("#udt_go_add").click(function(){
        //var popForm=$(this).parents("#update_from_address_modal");
        $('input[name=csn_address1]').val($('input[name=edit_R_address]').val())
        $('input[name=csn_address2]').val($('input[name=edit_R_appartment]').val())
        $('input[name=csn_address3]').val($('input[name=edit_R_department]').val())
        $('input[name=csn_pincode]').val($('input[name=edit_R_pincode]').val())
        $('input[name=csn_city_id]').val($('input[name=edit_R_city]').val())
        $('input[name=csn_state_id]').val($('input[name=edit_R_state]').val())
        $('input[name=R_other]').val($('input[name=edit_R_other]').val())
        
        $('#to_name').html($("input[name=csn_consignor]").val());
        $('#to_address').html($('input[name=csn_address1]').val()+' , '+$('input[name=csn_address2]').val()+' , '+$('input[name=csn_address3]').val()+' , '+$('input[name=csn_pincode]').val()+' , '+$('input[name=csn_city_id]').val()+' , '+$('input[name=R_other]').val());
        $('#to_number').html($("input[name=csn_contact_person]").val());
        
        $('#update_going_address_modal').modal('hide'); 
    });
</script>