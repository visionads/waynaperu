<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../../../vendor/autoload.php';
require __DIR__ . '/../../exception.php';
require __DIR__ . '/../../pdo.php';
require __DIR__ . '/../../mandrill.php';

$csrf = new \Maer\Security\Csrf\Csrf();
$session = new \CodeZero\Session\VanillaSession();
$session->store('flash', true);

$mailPremio = 'premios@wayna.com.pe';
$mailError = 'miguel.cabada@wayna.com.pe';

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
	$stmt = $pdo->prepare("INSERT INTO campaigns (email, names, surname_father, source, created_at, updated_at) VALUES (:email, :names, :surname_father, :source, :created_at, updated_at)");
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
	$html = infrajs\template\Template::parse(__DIR__ . '/../../template-error.php', $params);
	$message->setHtml( $html );
	$message->setSubject('Ooops - WaynaUP Nadar con lobos');
	$message->setFrom('info@wayna.com.pe', 'Wayna');
	$message->addRecipient( $mailError, 'Miguel Cabada' );
	$message->send();

} catch(UserExistsForCampaingException $ce) {
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
	'fullname' => $_POST['names'] .' '. $_POST['surname_father'],
	'email' => $_POST['email'],
];
$message = $mandrill->message();
$html = infrajs\template\Template::parse(__DIR__ . '/template.php', $params);
$message->setHtml( $html );
$message->setSubject('¡Sorteo Nadar con Lobos!');
$message->setFrom('info@wayna.com.pe', 'Wayna');
$message->addRecipient( $_POST['email'], $_POST['names'] );
$message->send();

// send mail wayna
$message = $mandrill->message();
$html = infrajs\template\Template::parse(__DIR__ . '/../../template-premios.php', $params);
$message->setHtml( $html );
$message->setSubject('¡Sorteo Nadar con Lobos!');
$message->setFrom('info@wayna.com.pe', 'Wayna');
$message->addRecipient( $mailPremio, 'Premios' );
$message->send();

$info = [
	'type' => 'success',
	'message' => "¡Felicidades {$_POST['names']}, estas inscrito para el sorteo!"
];

$session->store('info', $info);

$url = '/campaigns/nadarconlobos';
if( isset($_SERVER['HTTP_REFERER']) ) {
	$url = $_SERVER['HTTP_REFERER'];
}

header("Location: {$url}");
