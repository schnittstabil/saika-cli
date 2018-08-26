<?php

namespace Schnittstabil\Saika\Cli\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Schnittstabil\Saika\KasApi;

class ChownCommand extends KasApiBaseCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('chown');
        $this->setDescription('Change file owner.');
        $this->addOption(
            'recursive',
            'R',
            InputOption::VALUE_NONE,
            'Operate on files and directories recursively'
        );
        $this->addArgument('file', InputArgument::REQUIRED, '');
        $this->addArgument('owner', InputArgument::OPTIONAL, 'e.g. www-data; defaults to $KAS_AUTH_USER');
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $owner = $input->getArgument('owner');
        $recursive = $input->getOption('recursive');

        $this->getKasApi($input, $output)->chown($file, $owner, $recursive);
        return 0;
    }
}
