<?php

namespace ImpressCMS\Composer\AddonInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use ImpressCMS\Composer\AddonInstaller\LibraryInstaller\ModuleInstaller;
use ImpressCMS\Composer\AddonInstaller\LibraryInstaller\ThemeInstaller;
use ImpressCMS\Composer\AddonInstaller\LibraryInstaller\TranslationInstaller;
use ImpressCMS\Composer\AddonInstaller\Listeners\AutoloadDumpListener;

/**
 * Class that registers all customs installers and related events
 *
 * @package ImpressCMS\Composer\AddonInstaller
 */
class ComposerPlugin implements PluginInterface
{
    /**
     * Registered listeners collection
     *
     * @var callable[]
     */
    protected $registeredListeners = [];

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
            new ModuleInstaller($io, $composer, 'impresscms-module')
        );
        $installationManager->addInstaller(
            new ThemeInstaller($io, $composer, 'impresscms-theme')
        );
        $installationManager->addInstaller(
            new TranslationInstaller($io, $composer, 'impresscms-translation')
        );

        $this->addListener($composer, ScriptEvents::POST_AUTOLOAD_DUMP, [
            new AutoloadDumpListener(),
            'postAutoloadDump'
        ]);
    }

    /**
     * Add listener
     *
     * @param Composer $composer Composer instance
     * @param string $event Event
     * @param callable $listener Listener for event
     * @param int $priority Event handling priority
     */
    protected function addListener(Composer $composer, $event, callable $listener, $priority = -5)
    {
        $this->registeredListeners[] = $listener;
        $composer->getEventDispatcher()->addListener($event, $listener, $priority);
    }

    /**
     * @inheritDoc
     */
    public function deactivate(Composer $composer, IOInterface $io)
    {
        $installationManager = $composer->getInstallationManager();
        foreach (['impresscms-module', 'impresscms-theme', 'impresscms-translation'] as $type) {
            if ($installer = $installationManager->getInstaller($type)) {
                $installationManager->removeInstaller($installer);
            }
        }

        foreach ($this->registeredListeners as $listener) {
            $composer->getEventDispatcher()->removeListener($listener);
        }
    }

    /**
     * @inheritDoc
     */
    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}