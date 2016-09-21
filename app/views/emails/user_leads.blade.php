<html>
<head>
	<title>Lead Details</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="background: #FFFFFF; color: #000000; font-family: sans-serif; font-size: 14px; font-style: normal; " bgcolor="#FFFFFF">
<div style="max-width:850px;width:100%;margin:0 auto;">
<table>
	<tbody>
		<tr>
			<td>{{ trans('text.lead_name') }}:</td>
			<td>{{ $product->lead_name }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.lead_email') }}:</td>
			<td>{{ $product->lead_email }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.lead_phone') }}:</td>
			<td>{{ $product->lead_phone }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.exp_name') }}:</td>
			<td>{{ getExpName($p_id) }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.lead_address') }}:</td>
			<td>{{ $product->lead_address }}</td>
		</tr>
		
	</tbody>
</table>
</div>
</body>
</html>