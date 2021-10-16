<?php

namespace ImpressCMS\Composer\AddonInstaller\Utils;

use Composer\Composer;
use Composer\IO\IOInterface;
use Throwable;

/**
 * Tries to read ImpressCMS constants file
 *
 * @package ImpressCMS\Composer\AddonInstaller\Utils
 */
class ImpressCMSConstantsReader
{
    /**
     * Are constants loaded
     *
     * @var bool
     */
    private static $loaded = false;
    /**
     * @var Composer
     */
    private $composer;
    /**
     * @var IOInterface
     */
    private $IO;

    /**
     * ImpressCMSConstantsReader constructor.
     *
     * @param Composer $composer
     */
    public function __construct(Composer $composer, IOInterface $IO)
    {
        $this->composer = $composer;
        $this->IO = $IO;
    }

    /**
     * Checks if is loaded
     *
     * @return bool
     */
    public function isLoaded(): bool
    {
        return self::$loaded;
    }

    /**
     * Tries to get constant from file
     *
     * @param string $constantName Constant to return
     * @param int|string|bool|null $defaultValue Default value
     *
     * @return int|string|bool|null
     */
    public function getConstant(string $constantName, $defaultValue)
    {
        if (!self::$loaded) {
            $this->load();
        }
        return defined($constantName) ? constant($constantName) : $defaultValue;
    }

    /**
     * Load constants file
     */
    public function load()
    {
        if ($this->exists()) {
            try {
                $this->IO->write('Loading ImpressCMS constants file...');
                /** @noinspection PhpIncludeInspection */
                require_once $this->getFilename();
            } catch (Throwable $ex) {
                $this->IO->write('Np ImpressCMS constants file can\'t be loaded at this moment.');
            }
        } else {
            $this->IO->write('Np ImpressCMS constants file was found.');
        }
        self::$loaded = true;
    }

    /**
     * Checks if constant file exist
     *
     * @return bool
     */
    public function exists(): bool
    {
        return file_exists(
            $this->getFilename()
        );
    }

    /**
     * Get ImpressCMS constants file location
     *
     * @return string
     */
    public function getFilename(): string
    {
        return realpath(
            dirname(\Composer\Factory::getComposerFile()) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'constants.php'
        );
    }

}