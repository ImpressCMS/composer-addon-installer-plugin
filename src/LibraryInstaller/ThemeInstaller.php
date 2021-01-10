<?php

namespace ImpressCMS\Composer\AddonInstaller\LibraryInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Custom installer to install impresscms supported themes
 *
 * @package ImpressCMS\Composer\AddonInstaller\LibraryInstaller
 */
class ThemeInstaller extends LibraryInstaller
{

    /**
     * @inheritDoc
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $dir) = explode('/', $package->getName());

        if (str_starts_with($dir, 'impresscms-theme-')) {
            $dir = substr($dir, strlen('impresscms-theme-'));
        } elseif (str_starts_with($dir, 'theme-')) {
            $dir = substr($dir, strlen('theme-'));
        } elseif (str_ends_with($dir, '-theme')) {
            $dir = substr($dir, 0, -strlen('-theme'));
        }

        return './themes/' . $dir;
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return $packageType === 'impresscms-theme';
    }

}