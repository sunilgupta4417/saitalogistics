@include('emails.header')
    <h3>Dear {{ $emailContent['name'] }},</h3>
	<br/>
    <p>Details of your transaction given below:</p>
    <p>Receipt Reference No: {{ $emailContent['receipt_reference_no'] }}</p>
    <p>Account ID: {{ $emailContent['account_id'] }}</p>
    <p>AWB No: {{ $emailContent['awb_no'] }}</p>
    <p>Payment Amount: {{ $emailContent['amount'] }}</p>
    <p>Transaction Status: {{ $emailContent['payment_status'] }}</p>
    <p>Date and Time: {{ $emailContent['payment_date'] }}</p>
    <p>Mode of Payment: {{ $emailContent['payment_mode'] }}</p>
    <p>Customer Name: {{ $emailContent['customer_name'] }}</p>
    <p>Please quote your Receipt Reference Number for any queries relating to this request.</p>
@include('emails.footer')