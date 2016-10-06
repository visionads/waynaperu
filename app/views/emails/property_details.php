<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New product sale</title>
</head>
<body>

<style>
    table {}
    table td, table th { padding: 5px; line-height: 20px; text-align: left; font-size: 15px;}
    fieldset { margin: 0 !important; padding: 2%;}
    fieldset legend { border: 1px solid #909090 !important; padding:5px 8px;}
</style>
<div style="width: 90%; margin: 0 auto !important; background: #f0f0f0; padding: 2%;">
    <p style="background: #e0e0e0; padding: 10px;">
        Dear Provider,<br><br>
        A new product has been sold.
    </p>

    <h4 style="color: #0a6ebd; font-size: 20px;">Property Details</h4>

    <fieldset style="border: 1px solid #909090; width: 98%; height:auto;">
        <legend style="text-align:center; font-size:16px; font-weight:bold;">Property Details</legend><br><br>
        <table border="0">
            <tr>
                <td align="left">Price</td>
                <td>:</td>
                <th align="left"><?php echo $price;?></th>
            </tr>
            <tr>
                <td align="left">Order id</td>
                <td>:</td>
                <th align="left"><?php echo $id;?></th>
            </tr>
            <tr>
                <td>To Whom</td>
                <td>:</td>
                <th align="left"><?php echo $to_whom; ?></th>
            </tr>
            <tr>
                <td>Special</td>
                <td>:</td>
                <th align="left"><?php echo $special; ?></th>
            </tr>
            <tr>
                <td>Hits</td>
                <td>:</td>
                <th align="left"><?php echo $hits; ?></th>
            </tr>
            <tr>
                <td>Lead Name</td>
                <td>:</td>
                <th align="left"><?php echo $lead_name; ?></th>
            </tr>
            <tr>
                <td>Lead Email</td>
                <td>:</td>
                <th align="left"><?php echo $lead_email; ?></th>
            </tr>
            <tr>
                <td>Lead Phone</td>
                <td>:</td>
                <th align="left"><?php echo $lead_phone; ?></th>
            </tr>
            <tr>
                <td>Lead Address</td>
                <td>:</td>
                <th align="left"><?php echo $lead_address; ?></th>
            </tr>
        </table>
        <div style="clear: both">&nbsp;</div>
    </fieldset>
    <div style="clear: both">&nbsp;</div>
</div>


</body>
</html>