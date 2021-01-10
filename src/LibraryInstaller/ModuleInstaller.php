<?php

namespace ImpressCMS\Composer\AddonInstaller\LibraryInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Custom installer to install impresscms supported modules
 *
 * @package ImpressCMS\Composer\AddonInstaller\LibraryInstaller
 */
class ModuleInstaller extends LibraryInstaller
{
    /**
     * @inheritDoc
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $dir) = explode('/', $package->getName());

        if (str_starts_with($dir, 'impresscms-module-')) {
            $dir = substr($dir, strlen('impresscms-module-'));
        } elseif (str_starts_with($dir, 'module-')) {
            $dir = substr($dir, strlen('module-'));
        } elseif (str_ends_with($dir, '-module')) {
            $dir = substr($dir, 0, -strlen('-module'));
        }

        return './modules/' . $dir;
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return $packageType === 'impresscms-module';
    }

}