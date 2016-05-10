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

class AddonInstaller extends LibraryInstaller
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
        switch (getPackageType()){
            case 'impresscms-editor':
                $moddir = explode('/', $package->getName());
                $icms_modules = './editors/';
                $extra = $this->composer->getPackage()->getExtra();
                if (isset($extra['icms_editors_path'])) {
                    $icms_root = $extra['icms_editors_path'];
                }
                return $icms_modules . $moddir[1];
                break;
            case 'impresscms-module':
                $moddir = explode('/', $package->getName());
                $icms_modules = './modules/';
                $extra = $this->composer->getPackage()->getExtra();
                if (isset($extra['icms_modules_path'])) {
                    $icms_root = $extra['icms_modules_path'];
                }
                return $icms_modules . $moddir[1];
                break;
            case 'impresscms-theme':
                $moddir = explode('/', $package->getName());
                $icms_modules = './themes/';
                $extra = $this->composer->getPackage()->getExtra();
                if (isset($extra['icms_themes_path'])) {
                    $icms_root = $extra['icms_themes_path'];
                }
                return $icms_modules . $moddir[1];
                break;
            case 'impresscms-langpack':
                $moddir = explode('/', $package->getName());
                $icms_modules = './language/';
                $extra = $this->composer->getPackage()->getExtra();
                if (isset($extra['icms_language_path'])) {
                    $icms_root = $extra['icms_language_path'];
                }
                return $icms_modules . $moddir[1];
            case 'default':
                return FALSE;
            }

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
        return (in_array($packageType,["impresscms-editor","impresscms-module","impresscms-theme","impresscms-langpack"]));
    }
} 