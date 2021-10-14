<?php

namespace ImpressCMS\Composer\AddonInstaller\Listeners;

use Composer\IO\IOInterface;
use Composer\Script\Event;
use Composer\Util\ProcessExecutor;

/**
 * Listener that listens for autoload dump events
 *
 * @package ImpressCMS\Composer\AddonInstaller\Listeners
 */
class AutoloadDumpListener
{
    /**
     * Do some actions when autoload dump was completed
     *
     * @param Event $event
     */
    public function postAutoloadDump(Event $event)
    {
        $executor = \ImpressCMS\Composer\AddonInstaller\Utils\ProcessExecutor::createInstance(
            $event->getIO(),
            $event->getComposer()
        );
        $this->clearCaches($executor, $event->getIO());
    }

    /**
     * Clearing caches
     *
     * @param ProcessExecutor $executor Process executor instance
     * @param IOInterface $IO Input and output interface
     */
    protected function clearCaches(ProcessExecutor $executor, IOInterface $IO)
    {
        $IO->write("<info>Clearing caches...</info>");
        if ($executor->executeImpressCMSCommand("cache:clear") > 0) {
            $IO->write('  <warning>Clearing system cache failed</warning>');
        } else {
            $IO->write('  System cache cleared successfully');
        }
        if ($executor->executeImpressCMSCommand("templates:cache:clear") > 0) {
            $IO->write('  <warning>Clearing template cache failed</warning>');
        } else {
            $IO->write('  Template cache cleared successfully');
        }
    }

}