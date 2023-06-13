@include('emails.header')
    <h3>Dear {{ $emailContent['name'] }},</h3>
    <p>Greetings from Saita Logistics!!!</p>
    <p>Thank you for accepting the Quotation. We are applying space with the Shipping Line / Airlines for your valuable shipment. Will get back to you shortly.</p>
@include('emails.footer')