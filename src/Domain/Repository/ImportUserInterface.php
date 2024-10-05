<?php

namespace Domain\Repository;

use Application\DTO\User\UserCreateDTO;

interface ImportUserInterface {

    /**
     * @return array<UserCreateDTO>
     */
    public function import(): array;
}
