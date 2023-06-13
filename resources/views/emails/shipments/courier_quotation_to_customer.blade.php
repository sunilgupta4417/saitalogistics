@include('emails.header')
    <h3>Dear {{ $emailContent['name'] }},</h3>
    <p>Greetings from Saita Logistics!!!</p>
    <p>With reference to your inquiry dated {{ $emailContent['booking_date'] }}, please find enclosed the quotation for the courier shipment.</p>
    <p><strong>Origin:</strong> {{ $emailContent['origin'] }}</p>
    <p><strong>Destination:</strong> {{ $emailContent['destination'] }}</p>
    <p><strong>Chargeable Weight:</strong> {{ $emailContent['chargeable_weight'] }}</p>
    <p><strong>Shipping Charge:</strong> USD{{ $emailContent['shipping_charge'] }}</p>
    <p><strong>FCA Charges:</strong> USD{{ $emailContent['fca_charge'] }}</p>
    <p><strong>Ex Work Charges:</strong> USD{{ $emailContent['ex_work_charge'] }}</p>
    <p><strong>Total Charges:</strong> USD{{ $emailContent['total_charges'] }}</p>
    <hr/>
    <p><strong>Acceptance Link:</strong> <a href="{{ route('user.get_shipment') }}" target="_blank">Click here to accept quotation</a></p>
    <hr/>
    <p><strong>Terms:</strong> {{ route('terms_conditions') }}</p>
    <p><strong>Disclaimer:</strong></p>
    <ul>
        <li>The above charges are based on the information provided by the shipper/consignee.</li>
        <li>In case of volume shipment, Airlines weight will be considered as the final weight.</li>
        <li>The above rate is valid for 3 days from the quotation date.</li>
        <li>Duty & Taxes not included in the above quotation.</li>
        <li>Charges may vary once the final confirmation is received.</li>
    </ul>
@include('emails.footer')