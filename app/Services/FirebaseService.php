<?php 
namespace App\Services;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\Credentials\ServiceAccountJwtAccessCredentials;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;



class FirebaseService
{
    protected $database;
    protected $messaging;

    public function __construct()
    {
        try {
            $serviceAccount = ServiceAccountCredentials::fromWellKnownFile('/firebase-credentials.json');
            dd($serviceAccount);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->create();
        
            

        // $this->database = $firebase->getDatabase();
        // $this->messaging = $firebase->getMessaging();
    }

    public function getData($node)
    {
        return $this->database->getReference($node)->getValue();
    }

    public function setData($node, $data)
    {
        return $this->database->getReference($node)->set($data);
    }

    public function notification($token, $title, $body)
    {
        $message = CloudMessage::withTarget('token', $token)
        ->withNotification([
            'title' => $title,
            'body' => $body,
        ]);

        return $this->messaging->send($message);
    }
}