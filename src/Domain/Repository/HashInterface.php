<?php

namespace Domain\Repository;

use Domain\Model\User;

interface HashInterface {

    public function hashPassword(string $password): string;
}
