<?php
declare(strict_types=1);
namespace T3\CliConfig\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use T3\CliConfig\Service\ConfigurationService;

class ConfigurationCommand extends Command
{
    public function __construct(private readonly ConfigurationService $configurationService, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Sets global system settings.')

            ->addArgument('path', InputArgument::REQUIRED, 'Path to system configuration')
            ->addArgument('value', InputArgument::OPTIONAL, 'New value for given system configuration path')
            ->addOption('unset', null, InputOption::VALUE_NONE, 'If given, the whole entry in system configuration path is getting removed')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $path = $input->getArgument('path');
        $value = $input->getArgument('value');

        if (null === $path) {
            throw new \UnexpectedValueException('No path to system configuration given!');
        }
        if (null === $value && !$input->getOption('unset')) {
            throw new \UnexpectedValueException('You need to define a value for given system configuration path, or the "--unset" option!');
        }

        // The following lines have been copied from the great "helhum/typo3-console" package
        // and slightly modified.

        if (!$this->configurationService->localIsActive($path)) {
            $io->warning([
                sprintf('It seems that configuration for path "%s" is overridden.', $path),
                'Writing the new value might have no effect.'
            ]);
        }

        if ($input->getOption('unset')) {
            // Unset given path
            $removed = $this->configurationService->removeLocal($path);
            if (!$removed) {
                $io->warning(sprintf('Path "%s" seems invalid or empty. Nothing done!', $path));

                return Command::FAILURE;
            }

            $io->writeln(sprintf('<info>Removed "%s" from system configuration.</info>', $path));

            return Command::SUCCESS;
        }

        // Set value to given path
        $setWasAllowed = $this->configurationService->setLocal($path, $value);
        $isApplied = $this->configurationService->hasLocal($path);

        if (!$setWasAllowed) {
            $io->warning([
                sprintf('Could not set value "%s" for configuration path "%s".', $value, $path),
                'Possible reasons: configuration path is not allowed, configuration is not writable or type of value does not match given type.'
            ]);

            return Command::FAILURE;
        }

        if ($isApplied) {
            $io->writeln(sprintf('<info>Successfully set value for path "%s".</info>', $path));
        } else {
            $io->warning([
                sprintf('Value "%s" for configuration path "%s" seems not applied.', $value, $path),
                'Possible reasons: changed value in AdditionalConfiguration.php or extension ext_localconf.php'
            ]);
        }

        return Command::SUCCESS;
    }
}
