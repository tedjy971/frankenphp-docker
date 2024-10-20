<?php

namespace Application\UseCase\Sell;

use Application\DTO\Product\ProductCreateDTO;
use Application\UseCase\AbstractUseCase;
use Domain\Repository\ProductRepositoryInterface;
use Domain\Service\SellService;

 class AddProductToSellUseCase extends AbstractUseCase {


    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly SellService $sellService
    ) {
        parent::__construct();
    }

     protected function executeUseCase(mixed $useCaseInput = null): void {
         $this->sellService->validateCreateProduct($useCaseInput);

         $productToAdd = $this->sellService->generateProductToAdd($useCaseInput, $vatRate ?? 0.2);
         $this->productRepository->_save($productToAdd);

         $this->response->setSuccess(true);
         $this->response->setMessage('Product added with success');
     }
 }
