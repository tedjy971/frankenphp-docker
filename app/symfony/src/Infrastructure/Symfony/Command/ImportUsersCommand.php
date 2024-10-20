<?php

namespace Infrastructure\Symfony\Command;

use Application\UseCase\Import\ImportUserUseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import-users',
    description: 'Add a short description for your command',
)]
class ImportUsersCommand extends Command
{
    protected static $defaultName = 'app:import-users';

    public function __construct(private readonly ImportUserUseCase $importUserUseCase)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Importer des utilisateurs depuis un fichier (CSV ou XML)')
            ->addOption('type', null, InputOption::VALUE_REQUIRED, 'Le type d\'importation (csv ou xml)', 'csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Importation des utilisateurs');

        try {
            // Exécuter le Use Case d'importation
            $response =  $this->importUserUseCase->execute();
            if ($response->isSuccess()) {
                $io->success('Importation réussie');
            } else {
                $io->warning($response->getMessage());
                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $io->error('Une erreur est survenue lors de l\'importation : ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
