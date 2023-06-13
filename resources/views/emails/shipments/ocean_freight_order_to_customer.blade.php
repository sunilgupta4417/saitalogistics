@include('emails.header')
    <h3>Dear {{ $emailContent['name'] }},</h3>
    <p>Greetings from Saita Logistics!!!</p>
    <p>With reference to your inquiry dated {{ $emailContent['booking_date'] }}, please find enclosed the order for the Ocean Freight.</p>
    <p><strong>Origin:</strong> {{ $emailContent['origin'] }}</p>
    <p><strong>Destination:</strong> {{ $emailContent['destination'] }}</p>
    <p><strong>Container Type:</strong> {{ $emailContent['container_type'] }}</p>
@include('emails.footer')