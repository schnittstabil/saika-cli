<?php

namespace Schnittstabil\Saika\Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;

use Schnittstabil\Saika\KasApi;
use Schnittstabil\Get;

abstract class KasApiBaseCommand extends Command
{
    /**
     * @var KasApi
     */
    protected $kasApi;

    protected function configure()
    {
        parent::configure();

        $this->addOption(
            'user',
            null,
            InputOption::VALUE_REQUIRED,
            'all-inkl KAS login, defaults to $KAS_AUTH_USER environment variable',
            Get\env('KAS_AUTH_USER', null, false)
        );

        $this->addOption(
            'pass',
            null,
            InputOption::VALUE_REQUIRED,
            'all-inkl KAS password, defaults to $KAS_AUTH_PASS environment variable',
            Get\env('KAS_AUTH_PASS', null, false)
        );
    }

    /**
     * @param InputInterface $input
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getKasApi(InputInterface $input)
    {
        if ($this->kasApi === null) {
            $user = $input->getOption('user');
            $pass = $input->getOption('pass');
            $this->kasApi = KasApi::getInstance($user, $pass);
        }

        return $this->kasApi;
    }
}
