<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/contact", name="default", methods={"POST"})
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {
        $name = $request->request->get('name');
        $lastname = $request->request->get('lastname');
        $email = $request->request->get('email');
        $messageContent = $request->request->get('message');

        $body ="Name : $name \r\n Lastname : $lastname \r\n Email : $email \r\n Messahe :  $messageContent";
        $message = (new \Swift_Message('Enquiry from gotgroup'))
            ->setFrom( 'nabil@gotgroup.co.uk')
            ->setTo( 'enquiries@gotgroup.co.uk')
            ->setBody( $body, 'text/plain');

        $mailer->send($message);

        return $this->json([
            'status' => 'success',
            'message' => 'Message have been sent.',
        ]);
    }
}
