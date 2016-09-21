<html>
<head>
	<title>New Lead</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="background: #FFFFFF; color: #000000; font-family: sans-serif; font-size: 14px; font-style: normal; " bgcolor="#FFFFFF">
<div style="max-width:850px;width:100%;margin:0 auto;">
<table>
	<tbody>
		<tr>
			<td>{{ trans('text.lead_name') }}:</td>
			<td>{{ $name }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.lead_email') }}:</td>
			<td>{{ $email }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.lead_phone') }}:</td>
			<td>{{ $phone }}</td>
		</tr>
		<tr>
			<td>{{ trans('text.Interested_exp') }}</td>
			<td>{{ trans('text.exp_name') }}: {{ getExpName($p_id) }}
				<br>
				{{ trans('text.loc_name') }}: {{ getLocName($loc_id) }}
			</td>
		</tr>
	</tbody>
</table>
</div>
</body>
</html>