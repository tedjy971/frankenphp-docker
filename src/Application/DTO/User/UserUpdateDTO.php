<?php

namespace Application\DTO\User;
class UserUpdateDTO {

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;

    public function __construct(string $firstName, $lastName, string $email, string $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }
}
