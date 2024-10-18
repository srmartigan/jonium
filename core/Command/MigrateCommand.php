<?php

namespace Core\Command;

use Migrations\UserMigrations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MigrateCommand extends Command
{
    protected static $defaultName = 'migrate';

    protected function configure(){
        $this
            ->setName(self::$defaultName)
            ->setDescription('Migrar datos a la base de datos')
            ->setHelp('Este comando permite migrar los datos a la base de datos');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $io->title('Migrar datos');
        $io->section('Migrando datos');
        $io->newLine();
        $um = new UserMigrations();
        $um->up();
        $io->success('Datos migrados correctamente');

        return Command::SUCCESS;

    }
}
