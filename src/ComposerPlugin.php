<?php

namespace ImpressCMS\Composer\AddonInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use ImpressCMS\Composer\AddonInstaller\LibraryInstaller\ModuleInstaller;
use ImpressCMS\Composer\AddonInstaller\LibraryInstaller\ThemeInstaller;
use ImpressCMS\Composer\AddonInstaller\LibraryInstaller\TranslationInstaller;

/**
 * Class that registers all customs installers
 *
 * @package ImpressCMS\Composer\AddonInstaller
 */
class ComposerPlugin implements PluginInterface
{
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
        $installationManager = $composer->getInstallationManager();
        $installationManager->addInstaller(
            new ModuleInstaller($io, $composer)
        );
        $installationManager->addInstaller(
            new ThemeInstaller($io, $composer)
        );
        $installationManager->addInstaller(
            new TranslationInstaller($io, $composer)
        );
    }
} 