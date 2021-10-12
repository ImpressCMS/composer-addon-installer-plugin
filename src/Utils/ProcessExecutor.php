<?php

namespace ImpressCMS\Composer\AddonInstaller\Utils;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Util\ProcessExecutor as ComposerProcessExecutor;
use Exception;
use RuntimeException;
use Symfony\Component\Process\PhpExecutableFinder;

/**
 * Helper that lets easier to deal with processes
 *
 * @package ImpressCMS\Composer\AddonInstaller\Utils
 */
class ProcessExecutor extends ComposerProcessExecutor
{
    /**
     * Current composer instance
     *
     * @var Composer|null
     */
    protected $composer;

    /**
     * Creates instance of this class
     *
     * @param IOInterface $IO Input/output interface
     * @param Composer $composer Current composer instance
     * @return static
     */
    public static function createInstance(IOInterface $IO, Composer $composer)
    {
        $instance = new self($IO);
        return $instance->setComposer($composer);
    }

    /**
     * Sets current composer instance
     *
     * @param Composer $composer Composer to use
     *
     * @return $this
     */
    public function setComposer(Composer $composer)
    {
        $this->composer = $composer;

        return $this;
    }

    /**
     * Executes ImpressCMS console command (everything after bin/console only is needed)
     *
     * @param string $command Command to execute
     * @param mixed $output the output will be written into this var if passed by ref
     *                          if a callable is passed it will be used as output handler
     * @param  ?string $cwd     the working directory
     *
     * @return int
     *
     * @throws Exception
     */
    public function executeImpressCMSCommand($command, &$output = null, $cwd = null): int
    {
        return $this->executePHPCommand(
            $this->getBinDir() . DIRECTORY_SEPARATOR . 'console ' . $command,
            $output,
            $cwd
        );
    }

    /**
     * Executes PHP command (no php at the start needed)
     *
     * @param string $command Command to execute
     * @param mixed $output the output will be written into this var if passed by ref
     *                          if a callable is passed it will be used as output handler
     * @param  ?string $cwd     the working directory
     *
     * @return int
     */
    public function executePHPCommand($command, &$output = null, $cwd = null): int
    {
        return $this->execute(
            $this->getPhpExecCommand() . ' ' . $command,
            $output,
            $cwd
        );
    }

    /**
     * Gets PHP exec command (copied from composer source code)
     *
     * @return string
     */
    protected function getPhpExecCommand(): string
    {
        $finder = new PhpExecutableFinder();
        $phpPath = $finder->find(false);
        if (!$phpPath) {
            throw new RuntimeException('Failed to locate PHP binary to execute ' . $phpPath);
        }
        $phpArgs = $finder->findArguments();
        $phpArgs = $phpArgs ? ' ' . implode(' ', $phpArgs) : '';
        $allowUrlFOpenFlag = ' -d allow_url_fopen=' . ComposerProcessExecutor::escape(ini_get('allow_url_fopen'));
        $disableFunctionsFlag = ' -d disable_functions=' . ComposerProcessExecutor::escape(ini_get('disable_functions'));
        $memoryLimitFlag = ' -d memory_limit=' . ComposerProcessExecutor::escape(ini_get('memory_limit'));

        return ComposerProcessExecutor::escape($phpPath) . $phpArgs . $allowUrlFOpenFlag . $disableFunctionsFlag . $memoryLimitFlag;
    }

    /**
     * Get bin dir
     *
     * @return string
     *
     * @throws Exception
     */
    protected function getBinDir(): string
    {
        if ($this->composer === null) {
            throw new Exception('You must set composer before trying to execute ImpressCMS console command');
        }

        return realpath(
            $this->composer->getConfig()->get('bin-dir')
        );
    }

}