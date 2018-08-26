<?php

namespace Schnittstabil\Saika\Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;


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

    protected function getUser(InputInterface $input, OutputInterface $output)
    {
        $user = trim($input->getOption('user'));
        if ($user !== '') {
            return $user;
        }

        $helper = $this->getHelper('question');

        $question = new Question('Please enter your KAS login name: ');
        $question->setNormalizer(function ($value) {
            return $value === null ? null : trim($value);
        });
        $question->setValidator(function ($value) {
            if (empty($value)) {
                throw new \Exception('The name cannot be empty');
            }

            return $value;
        });
        $question->setMaxAttempts(2);

        return $helper->ask($input, $output, $question);
    }

    protected function getPass(InputInterface $input, OutputInterface $output)
    {
        $pass = trim($input->getOption('pass'));
        if ($pass !== '') {
            return $pass;
        }

        $helper = $this->getHelper('question');

        $question = new Question('Please enter your KAS login password: ');
        $question->setNormalizer(function ($value) {
            return $value === null ? null : trim($value);
        });
        $question->setValidator(function ($value) {
            if (empty($value)) {
                throw new \Exception('The password cannot be empty');
            }

            return $value;
        });
        $question->setHidden(true);
        $question->setMaxAttempts(2);

        return $helper->ask($input, $output, $question);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getKasApi(InputInterface $input, OutputInterface $output)
    {
        if ($this->kasApi === null) {
            $user = $this->getUser($input, $output);
            $pass = $this->getPass($input, $output);
            $this->kasApi = KasApi::getInstance($user, $pass);
        }

        return $this->kasApi;
    }
}
