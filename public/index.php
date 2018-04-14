<?php
// START: Force HTTPS
//if ($_SERVER["HTTPS"] != "on") {
//    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//    exit();
//}
// END: Force HTTPS

require_once('vendor/autoload.php');
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

// Define testing vars
$uname = "testinguser";
$secretkey = "testingkey";


$user_name = $_POST['username'];
$user_pass = $_POST['password'];

//login failed - Username Required!
if (strlen($user_name) == 0) {
        //die("Username Required!" . var_dump(http_response_code(401)));
        die(http_response_code(401));
}

//login failed - Password Required!
if (strlen($user_pass) == 0) {
        //die("Password Required!" . var_dump(http_response_code(401)));
        die(http_response_code(401));
}

require_once("conn.php");

//Lookup into where username and password match the given info

if (true) {
//      log them in!
//      echo $user_name . " Bob's your uncle "  . $user . "<br />";
        $signer = new Sha256();

        $token = (new Builder())->setIssuer('https://bob') // Configures the issuer (iss claim)
                        ->setAudience('https://bob') // Configures the audience (aud claim)
                        ->setId(mk_jti(), true) // Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                        ->setNotBefore(time()) // Configures the time that the token can be used (nbf claim)
                        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
                        ->set('uname', $uname) // Configures a new claim, called "uid"
                        ->sign($signer, $secretkey) // creates a signature using $secretkey from included file as key
                        ->getToken(); // Retrieves the generated token

        echo($token);

} else {
  // error message
        die("Failed to login!");
}
