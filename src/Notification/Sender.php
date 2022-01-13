<?php

namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class Sender
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendNexUserNotificationToAdmin(UserInterface $user)
    {
        $message = new Email();
        $message->from($user->getUserIdentifier())
            ->to('admin@series.com')
            ->subject('New account created!')
            ->html('<h1>New account!</h1>email: ' . $user->getUserIdentifier());
        $this->mailer->send($message);
    }
}