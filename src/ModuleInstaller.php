<?php
/**
 * Created by PhpStorm.
 * User: fiammy
 * Date: 29/08/14
 *
 *
 */

namespace ImpressCMS\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class ModuleInstaller extends LibraryInstaller
{
    /**
     * getPackageBasePath
     *
     * @param PackageInterface $package package being installed
     *
     * @return string install path relative to composer.json
     */
    public function getPackageBasePath(PackageInterface $package)
    {
        $moddir = explode('/', $package->getName());
        $icms_modules = './modules/';
        $extra = $this->composer->getPackage()->getExtra();
        if (isset($extra['icms_modules_path'])) {
            $icms_root = $extra['icms_modules_path'];
        }
        return $icms_modules . $moddir[1];
    }
    /**
     * supports - determine if this supports a given package type
     *
     * @param string $packageType package type name
     *
     * @return boolean true if packageType is supported
     */
    public function supports($packageType)
    {
        return 'impresscms-module' === $packageType;
    }
} 