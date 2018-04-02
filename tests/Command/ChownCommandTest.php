<?php
namespace Schnittstabil\Saika\Cli\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ChownCommandTest extends \PHPUnit\Framework\TestCase
{
    protected static $user;
    protected static $pass;

    public static function setUpBeforeClass()
    {
        $env = parse_ini_file(__DIR__ . '/../../.env', false, INI_SCANNER_RAW & INI_SCANNER_TYPED);
        self::$user = $env['KAS_AUTH_USER'];
        self::$pass = $env['KAS_AUTH_PASS'];
    }

    public function testExecute()
    {
        $application = new Application();

        $application->add(new ChownCommand());

        $command = $application->find('chown');
        $commandTester = new CommandTester($command);
        $exitCode = $commandTester->execute([
            'command'  => $command->getName(),
            '--user' => self::$user,
            '--pass' => self::$pass,
            'file' => 'cgi-bin'
        ]);

        $this->assertSame(0, $exitCode);
    }
}
