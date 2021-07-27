<?php

namespace Cs278\ComposerIncludeTestPlugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;

final class ComposerPlugin implements PluginInterface, Capable, CommandProviderCapability
{
    public function activate(Composer $composer, IOInterface $io)
    {

    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {

    }

    public function getCapabilities()
    {
        return [
            CommandProviderCapability::class => self::class,
        ];
    }

    public function getCommands(): array
    {
        return [
            new TestCommand(),
        ];
    }
}