<?php

// Users data
$imSettings['access']['users'] = array(
	'admin' => array(
		'id' => 'trc2925j',
		'groups' => array('wn6ylrp1'),
		'firstname' => 'Admin',
		'lastname' => '',
		'email' => 'admin',
		'password' => '$2a$11$O1wZ./hcakSfOK5KqSTeheMXDt.At0e1aHxFPaokxyJLGfPGyqO/2',
		'crypt_encoding' => 'csharp_bcrypt',
		'db_stored' => false,
		'page' => 'index.html'
	),
	'nouvel utilisateur' => array(
		'id' => 'fx4yomlx',
		'groups' => array('1sfhzj9s'),
		'firstname' => 'Nouvel utilisateur',
		'lastname' => '',
		'email' => 'nouvel utilisateur',
		'password' => '$2a$11$0R0j.zP76Wgljt/AorWUTOmy8LU1HEw2aPbBSIo17y6PX0.jySPDS',
		'crypt_encoding' => 'csharp_bcrypt',
		'db_stored' => false,
		'page' => 'index.html'
	)
);

// Admins list
$imSettings['access']['admins'] = array('trc2925j');

// Page/Users permissions
$imSettings['access']['pages'] = array();

// PASSWORD CRYPT

$imSettings['access']['password_crypt'] = array(
	'encoding_id' => 'php_default',
	'encodings' => array(
		'no_crypt' => array(
			'encode' => function ($pwd) { return $pwd; },
			'check' => function ($input, $encoded) { return $input == $encoded; }
		),
		'php_default' => array(
			'encode' => function ($pwd) { return password_hash($pwd, PASSWORD_DEFAULT); },
			'check' => function ($input, $encoded) { return password_verify($input, $encoded); }
		),
		'csharp_bcrypt' => array(
			'encode' => function ($pwd) { return password_hash($pwd, PASSWORD_BCRYPT); },
			'check' => function ($input, $encoded) { return password_verify($input, $encoded); }
		)
	)
);

// End of file access.inc.php