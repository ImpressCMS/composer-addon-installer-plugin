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

class LanguageInstaller extends LibraryInstaller
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
        $langdir = explode('/', $package->getName());
        $icms_langs = './languages/';
        $extra = $this->composer->getPackage()->getExtra();
        if (isset($extra['icms_languages_path'])) {
            $icms_root = $extra['icms_languages_path'];
        }
        return $icms_langs . $langdir[1];
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
        return 'impresscms-language' === $packageType;
    }
} 