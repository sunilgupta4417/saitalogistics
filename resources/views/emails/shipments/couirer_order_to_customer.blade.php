@include('emails.header')
    <h3>Dear {{ $emailContent['name'] }},</h3>
    <p>Greetings from Saita Logistics!!!</p>
    <p>With reference to your inquiry dated {{ $emailContent['booking_date'] }}, please find enclosed the order for the Courier.</p>
    <p><strong>Origin:</strong> {{ $emailContent['origin'] }}</p>
    <p><strong>Destination:</strong> {{ $emailContent['destination'] }}</p>
@include('emails.footer')