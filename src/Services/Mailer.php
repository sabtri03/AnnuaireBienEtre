<?php
/**
 * Created by PhpStorm.
 * User: strifi
 * Date: 07-Feb-19
 * Time: 21:06
 */

namespace App\Services;


class Mailer
{

    private $mailer;
    private $templating;
    /**
     *
     *@var $mailer \swift_Mailer $mailer
     */
    Public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer =$mailer;
        $this->templating = $templating;
    }

    Public function sendMail($context="default", $email, $id)
    {
        $message = (new \Swift_Message('Activation'))
            ->setFrom("sabtri@hotmail.com")
            ->setTo($email)
            ->setBody(
                $this->templating->render(
                // templates/emails/registration.html.twig
                    'email/registration.html.twig',
                    [
                        'name' => $email,
                        'id' => $id,
                        ]
                ),
                'text/html'
            );
        $this->mailer->send($message);
        Return;
    }

}