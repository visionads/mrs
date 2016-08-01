<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div class="well">
    <p>Dear User,</p>
    <p>Your Payment status for the payment of {{ $invoice['invoice_no'] }} is <b>{{ $status }}</b></p>
</div>

</body>
</html>