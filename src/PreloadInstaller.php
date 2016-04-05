<?php
/**
 * Created by PhpStorm.
 * User: fiammybe
 * Date: 15/10/15
 *
 *
 */

namespace ImpressCMS\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class PreloadInstaller extends LibraryInstaller
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
        $preloaddir = explode('/', $package->getName());
        $icms_preloads = './plugins/preloads';
        $extra = $this->composer->getPackage()->getExtra();
        if (isset($extra['icms_preload_path'])) {
            $icms_root = $extra['icms_preload_path'];
        }
        return $icms_preloads . $preloaddir[1];
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
        return 'impresscms-preload' === $packageType;
    }
} 