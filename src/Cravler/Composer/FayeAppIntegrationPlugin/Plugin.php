<?php

namespace Cravler\Composer\FayeAppIntegrationPlugin;

use Composer\Plugin\PluginInterface;
use Composer\Composer;
use Composer\IO\IOInterface;

/**
 * @author Sergei Vizel <sergei.vizel@gmail.com>
 */
class Plugin implements PluginInterface
{
    /**
     * @inheritDoc
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->addInstaller(new Installer($io, $composer));
    }
}
