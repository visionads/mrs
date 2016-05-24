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

<div style="background-color: #0490a6; height: 25px;">
    <h3 class="text-center text-green"><b style="color: #f5f5f5">Payment for the order {{ $payment_details['transaction']->invoice_no }}</b></h3>
</div>


<table width="100%">
    <tr>
        <th colspan="2" class="text-center">PAYMENT INFORMATION</th>
    </tr>
    <tr>
        <th width="30%">Invoice No</th>
        <td width="60%">{{ isset($payment_details['transaction']->invoice_no)?$payment_details['transaction']->invoice_no:''}}</td>
    </tr>
    <tr>
        <th>Currency</th>
        <td>{{ isset($payment_details['transaction']->currency)?$payment_details['transaction']->currency:''}}</td>
    </tr>
    <tr>
        <th>Amount</th>
        <td>{{ isset($payment_details['payment']->amount)?'$'.$payment_details['payment']->amount:''}}</td>
    </tr>
    <tr>
        <th>Payment Date</th>
        <td>{{ isset($payment_details['payment']->created_at)?date('d M Y',strtotime($payment_details['payment']->created_at)):''}}</td>
    </tr>
</table>


</body>
</html>