<?php

namespace Domain\Model;

use DateTime;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



class Skill
{
    private ?int $id = null;
    private string $name;
    private int $level;

}
