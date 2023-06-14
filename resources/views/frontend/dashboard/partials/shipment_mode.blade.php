<div class="maining-heading">
    <h3 class="mb-4">Shipment Mode</h3>
</div>
<div class="form-group agreed-text full-widthing">
    <label>Would you like to pickup your shipment?</label>
    <label class="container">
        <p><b>I'll Drop off shipment</b></p>
        <input type="radio" checked="checked" name="cpickup" value="DROPOFF" onclick="show1();">
        <span class="checkmark"></span>
    </label>
</div>
<div class="form-group agreed-text full-widthing">
    <label class="container">
        <p><b>Yes pickup my shipment</b></p>
        <input type="radio" name="cpickup" value="PICKUP" onclick="show2();">
        <span class="checkmark"></span>
    </label>
</div>
<div class="form-group">
    <label>Appointment date and time</label>
    <input type="datetime-local" name="booking_date">
</div>
<div id="div1" class="">
    <div class="pickup-details">
        <div class="pickup-details-iner">
            <h3>Pickup Address</h3>
            <div class="maing-address">
                <h4 id="pickup_from_company_name">xxxxx</h4>
                <p id="pickup_from_name">xxxxx</p>
                <p id="pickup_from_address">xxxxxxx</p>
                <b id="pickup_from_number">+xxxxxx</b>
                <?php /*<div class="pickup-details-link">
                    <a href="javascript:void(0);" class="edit_frm_ad_btn">Edit</a>
                </div>*/?>
            </div>
        </div>
    </div>
</div>
@section('extra_body_scripts')
    <script>
        var today = new Date().toISOString().slice(0, 16);
        document.getElementsByName("booking_date")[0].min = today;
    </script>
    @include('frontend.dashboard.partials.form_custom_js')
@endsection