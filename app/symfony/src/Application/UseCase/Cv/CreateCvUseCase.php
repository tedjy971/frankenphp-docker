<?php

namespace Application\UseCase\Cv;

use Application\DTO\Cv\CvCreateDTO;
use AutoMapper\AutoMapperInterface;
use Domain\Model\CV;
use Domain\Repository\CvRepositoryInterface;

readonly class CreateCvUseCase {

    private CVRepositoryInterface $repository;

    public function __construct(CVRepositoryInterface $repository, AutoMapperInterface $autoMapper) {
        $this->repository = $repository;
    }

    public function execute(CvCreateDTO $cv): void {

        dd($cv);



        $this->repository->save($cv);
    }
}
