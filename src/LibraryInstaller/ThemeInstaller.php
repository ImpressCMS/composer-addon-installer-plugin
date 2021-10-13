<?php

namespace ImpressCMS\Composer\AddonInstaller\LibraryInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use ImpressCMS\Composer\AddonInstaller\Utils\ImpressCMSConstantsReader;
use ImpressCMS\Composer\AddonInstaller\Utils\StrHelper;

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

        if (StrHelper::str_starts_with($dir, 'impresscms-theme-')) {
            $dir = substr($dir, strlen('impresscms-theme-'));
        } elseif (StrHelper::str_starts_with($dir, 'theme-')) {
            $dir = substr($dir, strlen('theme-'));
        } elseif (StrHelper::str_ends_with($dir, '-theme')) {
            $dir = substr($dir, 0, -strlen('-theme'));
        }

        $constantsReader = new ImpressCMSConstantsReader($this->composer, $this->io);
        return $constantsReader->getConstant('ICMS_THEME_PATH', './themes') . '/' . $dir;
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return $packageType === 'impresscms-theme';
    }

}