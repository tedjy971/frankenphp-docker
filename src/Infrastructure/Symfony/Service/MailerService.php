<?php

namespace Infrastructure\Symfony\Service;

use Domain\Model\User;
use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Symfony\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;

readonly class MailerService implements \Domain\Repository\MailerInterface {

    public function __construct(private MailerInterface $mailer, private EmailVerifier $emailVerifier, private UserRepositoryInterface $userRepository) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail(User $user, string $subject, string $body): void {
        $email = (new Email())
            ->to($user->getEmail())
            ->subject($subject)
            ->text($body);

        $this->mailer->send($email);
    }

    public function sendEmailConfirmation(User $user): void {
        $doctrineUser = $this->userRepository->findOneBy(['email' => $user->getEmail()]);

        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $doctrineUser,
            (new TemplatedEmail())
                ->from(new Address('mailer@domain.com', 'MailBot'))
                ->to((string)$user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
    }

}
