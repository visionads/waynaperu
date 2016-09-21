<?php

return array(
	'table' => 'oauth_identities',
	'providers' => array(
		'facebook' => array(
			'client_id' => '751960604948944',
			'client_secret' => '14a09143476dea364b3b87fb6b1100d1',
			'redirect_uri' => URL::to('facebook/login'),
			'scope' => array(),
		),
		'google' => array(
			'client_id' => '84675347025-99ghbpju1ejjuj7e8cnq1e062lq2uiof.apps.googleusercontent.com',
			'client_secret' => 'A8u0cz8uxWQ9f1cX4zr3rZUU',
			'redirect_uri' => URL::to('google/login'),
			'scope' => array(),
		),
		'github' => array(
			'client_id' => '12345678',
			'client_secret' => 'y0ur53cr374ppk3y',
			'redirect_uri' => URL::to('your/github/redirect'),
			'scope' => array(),
		),
		'linkedin' => array(
			'client_id' => '12345678',
			'client_secret' => 'y0ur53cr374ppk3y',
			'redirect_uri' => URL::to('your/linkedin/redirect'),
			'scope' => array(),
		),
		'instagram' => array(
			'client_id' => '12345678',
			'client_secret' => 'y0ur53cr374ppk3y',
			'redirect_uri' => URL::to('your/instagram/redirect'),
			'scope' => array(),
		),
	)
);
