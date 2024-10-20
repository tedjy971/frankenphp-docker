<?php

namespace Application\DTO\User;
use Application\DTO\AbstractDTO;
use Domain\Model\User;

class UserCreateDTO extends AbstractDTO {

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $plainPassword;

    public function __construct() {
    }
}
