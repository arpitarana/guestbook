<?php

namespace App\Service\User;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User\User;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class MailManager
 * @package App\Service\User
 */
class MailManager
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Swift_Mailer */
    private $mailer;
    /** @var EngineInterface */
    private $templating;
    /** @var string */
    private $mailerUser;

    /**
     * MailManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param \Swift_Mailer $mailer
     * @param EngineInterface $templating
     * @param string $mailerUser
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        $mailerUser
    ) {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->mailerUser = $mailerUser;
    }


    /**
     * @param User $user
     * @return bool
     */
    public function forgotPassword(User $user)
    {
        $emailTemplate = $this->templating->render(
            'user/email/forgot_password.html.twig',
            [
                'userFirstName' => $user->getFirstName(),
                'password' => $user->getRawPassword(),
                'username' => $user->getUsername(),
            ]
        );

        $message = (new \Swift_Message('Forgot Password'))
            ->setFrom($this->mailerUser)
            ->setTo($user->getEmail())
            ->setBody($emailTemplate, 'text/html');

        try {
            $this->mailer->send($message);
            return true;
        }
        catch (\Exception $e) {
            $e->getMessage();
            return false;
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function changePasswordEmail(User $user)
    {
        $emailTemplate = $this->templating->render(
            'user/email/change_password.html.twig',
            [
                'password' => $user->getRawPassword(),
                'username' => $user->getUsername(),
                'userFirstName' => $user->getFirstName(),
            ]
        );

        $message = (new \Swift_Message('Change Password'))
            ->setFrom($this->mailerUser)
            ->setTo($user->getEmail())
            ->setBody($emailTemplate, 'text/html');

        $this->mailer->send($message);

        try {
            $this->mailer->send($message);
            return true;
        }
        catch (\Exception $e) {
            $e->getMessage();
            return false;
        }
    }
}
