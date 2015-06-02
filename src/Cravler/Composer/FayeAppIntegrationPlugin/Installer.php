<?php

namespace Cravler\Composer\FayeAppIntegrationPlugin;

use Composer\Composer;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

/**
 * @author Sergei Vizel <sergei.vizel@gmail.com>
 */
class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        if (in_array($packageType, array('faye-app-integration', 'faye-app-integration-plugin'))) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function getPackageBasePath(PackageInterface $package)
    {
        $targetPath = '.faye-app';

        if ('faye-app-integration-plugin' == $package->getType()) {
             $targetPath .= '/plugins';
        }

        if ($targetPath && !file_exists($targetPath)) {
            mkdir($targetPath, 0777, true);
        }

        if ('faye-app-integration-plugin' == $package->getType()) {
            return $targetPath. '/' . $package->getPrettyName();
        }

        return  $targetPath;
    }
}
