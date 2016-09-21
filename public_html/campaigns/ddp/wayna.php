<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../exception.php';
require __DIR__ . '/../pdo.php';
require __DIR__ . '/../mandrill.php';

$csrf = new \Maer\Security\Csrf\Csrf();
$session = new \CodeZero\Session\VanillaSession();
$session->store('flash', true);

$campaign = [
	'name' => 'Wayna DDP',
	'mail' => [
		'oops' => [
			'subject' => 'Ooops - Wayna DDP',
			'to' => [
				'email' => 'miguel.cabada@wayna.com.pe',
				'name' => 'Miguel Cabada'
			],
			'from' => [
				'email' => 'info@wayna.com.pe',
				'name' => 'Wayna'
			]
		],
		'awards' => [
			'subject' => '¡Sorteo Día del Padre!',
			'to' => [
				'email' => 'premios@wayna.com.pe',
				'name' => 'Premios Wayna'
			],
			'from' => [
				'email' => 'info@wayna.com.pe',
				'name' => 'Wayna'
			]
		],

	]
];

try {
	if (!isset($_POST['csrftoken']) || !$csrf->validateToken($_POST['csrftoken']) ) {
		throw new \Exception("Formulario invalido, vuelva a intentarlo.", 1);
	}

	$validator = new \Forestry\FormValidator\Validator();

	$rules = [
	    'names' => 'required|alpha',
	    'surname_father' => 'required|alpha',
	    'email' => 'required|email',
	    'terms' => 'boolean|required',
	];

	$validator->validate($_POST, $rules);

	if ( $validator->hasErrors() ) {
	    throw new \Exception("Alguno de los datos enviados son incorrectos. Vuelva a intentarlo.", 1);
	}

	// find record
	$stmt = $pdo->prepare("SELECT id FROM campaigns WHERE email = :email AND source = :source");
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':source', $_POST['source']);	
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if( $row ) {
	    throw new \UserExistsForCampaingException("Hola {$_POST['names']}, gracias por participar.", 1);
	}

	// save record
	$hoy = date('Y-m-d h:i:s');
	$sql = "INSERT INTO campaigns"
		 . "(email, names, surname_father, source, created_at, updated_at) "
		 . "VALUES "
		 . "(:email, :names, :surname_father, :source, :created_at, :updated_at);";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':names', $_POST['names']);
	$stmt->bindParam(':surname_father', $_POST['surname_father']);
	$stmt->bindParam(':source', $_POST['source']);
	$stmt->bindParam(':created_at', $hoy);
	$stmt->bindParam(':updated_at', $hoy);
	$stmt->execute();

} catch(\PDOException $pe) {
	// notifica el error;
	$message = $mandrill->message();
	$params = [
		'message' => $pe->getMessage(),
		'line' => $pe->getLine(),
		'file' => $pe->getFile(),
	];
	$html = infrajs\template\Template::parse(__DIR__ . '/../template-error.php', $params);
	$message->setHtml( $html );
	$message->setSubject( $campaign['mail']['oops']['subject'] );
	$message->setFrom($campaign['mail']['oops']['from']['email'], $campaign['mail']['oops']['from']['name']);
	$message->addRecipient( $campaign['mail']['oops']['to']['email'], $campaign['mail']['oops']['to']['name'] );
	$message->send();
} catch(\UserExistsForCampaingException $ce) {
	$info = [
		'type' => 'info',
		'message' => $ce->getMessage()
	];

    $session->store('info', $info);
} catch(\Exception $e) {
	$info = [
		'type' => 'error',
		'message' => $e->getMessage()
	];

    $session->store('info', $info);
}

// send mail user
$params = [
	'fullname' => $_POST['names'],
	'email' => $_POST['email'],
];
$message = $mandrill->message();
$html = infrajs\template\Template::parse(__DIR__ . '/template.php', $params);
$message->setHtml( $html );
$message->setSubject( $campaign['mail']['awards']['subject'] );
$message->setFrom( $campaign['mail']['awards']['from']['email'], $campaign['mail']['awards']['from']['name'] );
$message->addRecipient( $params['email'], $params['fullname'] );
$message->send();

// send mail wayna
$message = $mandrill->message();
$html = infrajs\template\Template::parse(__DIR__ . '/../template-premio.php', $params);
$message->setHtml( $html );
$message->setSubject( $campaign['mail']['awards']['subject'] );
$message->setFrom( $campaign['mail']['awards']['from']['email'], $campaign['mail']['awards']['from']['name'] );
$message->addRecipient( $campaign['mail']['awards']['to']['email'], $campaign['mail']['awards']['to']['name'] );
$message->send();

$info = [
	'type' => 'success',
	'message' => "¡Felicidades {$_POST['names']}, estas inscrito para el sorteo!"
];

$session->store('info', $info);

$url = '/campaigns/ddp';
if( isset($_SERVER['HTTP_REFERER']) ) {
	$url = $_SERVER['HTTP_REFERER'];
}

header("Location: {$url}");
