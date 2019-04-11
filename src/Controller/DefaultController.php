<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/contact", name="default")
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {
        
        $mail = json_decode($request->getContent());
        if( $mail->name && $mail->lastname && $mail->phone && $mail->email && $mail->message){
            $name = $mail->name;
            $lastname = $mail->lastname;
            $email = $mail->email;
            $messageContent = $mail->message;
            $phone = $mail->phone;

            $body = "Name : $name \r\n Lastname : $lastname \r\n Phone : $phone \r\n Email : $email \r\n Messahe :  $messageContent";
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('nabil@gotgroup.co.uk')
                ->setTo('jahir.nabil.wrk@gmail.com')
                ->setBody($body, 'text/plain');

            $mailer->send($message);

            return $this->json([
                'status' => 'success',
                'message' => 'Message have been sent.',
            ]);
        }
        else{
            return $this->json([
                'status' => 'error',
                'message' => 'Required fields missing!',
            ]);
        }
        
    }
}
