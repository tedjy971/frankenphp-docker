<?php

namespace Domain\Repository;

use Domain\Model\User;

interface MailerInterface {

    public function sendEmail(User $user, string $subject, string $body): void;

    public function sendEmailConfirmation(User $user): void;
}
