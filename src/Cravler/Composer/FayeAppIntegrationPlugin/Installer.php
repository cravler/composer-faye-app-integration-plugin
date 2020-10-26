<?php

namespace Cravler\Composer\FayeAppIntegrationPlugin;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

/**
 * @author Sergei Vizel <sergei.vizel@gmail.com>
 */
class Installer extends LibraryInstaller
{
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
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return $this->getPackageBasePath($package);
    }

    /**
     * {@inheritDoc}
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
            return $targetPath. '/' . str_replace('/', '-', $package->getPrettyName());
        }

        return  $targetPath;
    }
}
