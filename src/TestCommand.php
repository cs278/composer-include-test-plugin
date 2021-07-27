<?php

namespace Cs278\ComposerIncludeTestPlugin;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

final class TestCommand extends BaseCommand
{
    protected function configure()
    {
        $this->setName('test-plugin');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('PHP/%s', \PHP_VERSION));

        if (\function_exists('str_contains')) {
            $output->writeln(sprintf(
                'str_contains? YES (%s)',
                self::isFunctionInternal('str_contains') ? 'internal' : 'user-defined',
            ));
        } else {
            $output->writeln(sprintf(
                'str_contains? NO',
            ));
        }
        
        $output->writeln(sprintf('bootstrap.php included? %s', ($GLOBALS['cs278__bootstrap'] ?? false) ? 'YES' : 'NO'));
        $output->writeln(sprintf('Yaml::parse? %s', print_r(Yaml::parse('{foo: "bar"}'), true)));
    }

    private static function isFunctionInternal(string $funcName): bool
    {
        if (!\function_exists($funcName)) {
            throw new \Exception();
        }

        return (new \ReflectionFunction($funcName))->isInternal();
    }
}