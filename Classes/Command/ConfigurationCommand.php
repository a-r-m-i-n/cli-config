<?php

namespace T3\CliConfig\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ConfigurationCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setDescription('Sets global system settings.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->writeln('TODO');

        return Command::SUCCESS;
    }
}
