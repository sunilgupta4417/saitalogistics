@include('emails.header')
    <h3>Dear {{ $emailContent['name'] }},</h3>
    <p>Greetings from Saita Logistics!!!</p>
    <p>Thanks for confirming the booking with Saita Logistics.</p>
    <p><strong>Booking Date:</strong> {{ $emailContent['booking_date'] }}</p>
    <p><strong>Origin:</strong> {{ $emailContent['origin'] }}</p>
    <p><strong>Destination:</strong> {{ $emailContent['destination'] }}</p>
    <p><strong>Shipper:</strong> {{ $emailContent['shipper_name'] }}</p>
    <p><strong>Consignee:</strong> {{ $emailContent['receiver_name'] }}</p>
    <p><strong>Mode:</strong> {{ $emailContent['shipment_mode'] }}</p>
    <p>Please click on the below mentioned link to process the payment.</p>
    <p><strong>Payment Link:</strong> <a href="{{ $emailContent['payment_link'] }}" target="_blank">Click here to pay</a></p>
@include('emails.footer')