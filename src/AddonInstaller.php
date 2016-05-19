<?php
/**
 * Created by PhpStorm.
 * User: fiammy
 * Date: 29/08/14
 */
namespace ImpressCMS\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
/**
 * Composer installer for ImpressCMS modules
 */
class AddonInstaller extends LibraryInstaller
{
    $package_type = array('impresscms-module', 'impresscms-theme', 'impresscms-editor');

    /**
     * getPackageBasePath
     *
     * @param PackageInterface $package package being installed
     *
     * @return string install path relative to composer.json
     */
    public function getInstallPath(PackageInterface $package)
    {
        switch ($package->getType()) {
            case 'impresscms-module':
                $moddir = explode('/', $package->getName());
                $icms_basepath = './modules/';
                $extra = $package->getExtra();
                if (isset($extra['icms_modules_path'])) {
                    $icms_basepath = $extra['icms_modules_path'];
                }
                break;
            case 'impresscms-theme':
                $moddir = explode('/', $package->getName());
                $icms_basepath = './themes/';
                $extra = $package->getExtra();
                if (isset($extra['icms_themes_path'])) {
                    $icms_basepath = $extra['icms_themes_path'];
                }
                break;

            case 'impresscms-translation':
                $moddir = explode('/', $package->getName());
                $icms_basepath = './language/';
                $extra = $package->getExtra();
                if (isset($extra['icms_translations_path'])) {
                    $icms_basepath = $extra['icms_translations_path'];
                }
                break;
            case 'impresscms-plugin':
                $moddir = explode('/', $package->getName());
                $icms_basepath = './plugins';
                $extra = $package->getExtra();
                if (isset($extra['icms_plugins_path'])) {
                    $icms_basepath = $extra['icms_plugins_path'];
                }
                break;

            case 'impresscms-editor':
                $moddir = explode('/', $package->getName());
                $icms_basepath = './editors/';
                $extra = $package->getExtra();
                if (isset($extra['icms_editors_path'])) {
                    $icms_basepath = $extra['icms_editors_path'];
                }
                break;
        }
        return $icms_basepath . $moddir[1];
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