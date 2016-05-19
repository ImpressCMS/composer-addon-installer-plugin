<?php
/**
 * Created by PhpStorm.
 * User: fiammy
 * Date: 29/08/14
 *
 */
namespace ImpressCMS\Composer;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
class AddonInstallerPlugin implements PluginInterface {
    /**
     * activate - add our installer to composer
     *
     * @param Composer $composer composer instance
     * @param IOInterface $io composer i/o
     *
     * @return void
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new AddonInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
} 