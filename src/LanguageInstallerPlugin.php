<?php
/**
 * Created by PhpStorm.
 * User: fiammy
 * Date: 15/10/15
 *
 */

namespace ImpressCMS\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class LanguageInstallerPlugin implements PluginInterface {
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
        $installer = new LanguageInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
} 