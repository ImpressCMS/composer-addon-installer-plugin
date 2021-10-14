<?php

namespace ImpressCMS\Composer\AddonInstaller\Utils;

use Composer\Composer;
use Composer\IO\IOInterface;
use Dotenv\Dotenv;

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
            $this->IO->write('Loading ImpressCMS constants file...');
            /** @noinspection PhpIncludeInspection */
            require_once $this->getFilename();
        } else {
            $this->IO->write('Np ImpressCMS constants file was found or composer plugin can\'t load it.');
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
        return class_exists(Dotenv::class) &&
            function_exists('env') &&
            file_exists(
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
            $this->composer->getPackage()->getTargetDir() . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'constants.php'
        );
    }

}