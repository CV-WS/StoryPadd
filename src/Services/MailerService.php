<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerService
{
    private string $rootName = '';

    public function __construct()
    {
        $this->rootName = $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * @throws GuzzleException
     * @throws IdentityProviderException
     */
    public function send()
    {
        // Charger les identifiants OAuth depuis le fichier JSON
        $root = $this->rootName . '/google.json';
        $googleCredentials = json_decode(file_get_contents($root), true);
        $clientId = $googleCredentials['web']['client_id'];
        $clientSecret = $googleCredentials['web']['client_secret'];
        $refreshToken = '1//043FfIW1V7RgCCgYIARAAGAQSNwF-L9IrXCha7fYSmwAQeqaBJuBcdFae1R2KfLy9gYTrhTb9sbvCkjwrbhzMmoCzfBG-gP9HSA8';

        // Configuration OAuth2
        $provider = new Google([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'redirectUri' => 'https://developers.google.com/oauthplayground',
        ]);

        try {
            $oauthToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $refreshToken
            ]);

            $accessToken = $oauthToken->getToken();  // Utilisez le token pour l'authentification SMTP
        } catch (IdentityProviderException $e) {
            die('Erreur OAuth2 : ' . $e->getMessage());
        }

        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->AuthType = 'XOAUTH2';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Authentification OAuth2
            $mail->setOAuth(new \PHPMailer\PHPMailer\OAuth([
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'accessToken' => $accessToken,  // Assurez-vous d'utiliser l'access token
                'userName' => 'phpmailer080@gmail.com'
            ]));

            // Expéditeur et destinataires
            $mail->setFrom('phpmailer080@gmail.com', 'Mailer');
            $mail->addAddress('vergueiro.steven@gmail.com', 'Joe User');
            $mail->addReplyTo('phpmailer080@gmail.com', 'Information');

            // Contenu du mail
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
