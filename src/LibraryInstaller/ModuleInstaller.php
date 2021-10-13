<?php

namespace ImpressCMS\Composer\AddonInstaller\LibraryInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use ImpressCMS\Composer\AddonInstaller\Utils\ImpressCMSConstantsReader;
use ImpressCMS\Composer\AddonInstaller\Utils\StrHelper;

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

        if (StrHelper::str_starts_with($dir, 'impresscms-module-')) {
            $dir = substr($dir, strlen('impresscms-module-'));
        } elseif (StrHelper::str_starts_with($dir, 'module-')) {
            $dir = substr($dir, strlen('module-'));
        } elseif (StrHelper::str_ends_with($dir, '-module')) {
            $dir = substr($dir, 0, -strlen('-module'));
        }

        $constantsReader = new ImpressCMSConstantsReader($this->composer, $this->io);
        return $constantsReader->getConstant('ICMS_MODULES_PATH', './modules') . '/' . $dir;
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return $packageType === 'impresscms-module';
    }

}