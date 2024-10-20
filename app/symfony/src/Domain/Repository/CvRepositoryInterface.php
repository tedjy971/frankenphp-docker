<?php

namespace Domain\Repository;


use Domain\Model\CV;

interface CvRepositoryInterface {


    public function _findById(int $id): ?Cv;

    public function _save(Cv $cv): void;

    public function _delete(Cv $cv): void;

    public function _findByName(string $name): array;

    public function _findByMail(string $getEmail) ;

}
