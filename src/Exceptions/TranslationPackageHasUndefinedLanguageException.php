<?php

namespace ImpressCMS\Composer\AddonInstaller\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Exception that is thrown if package has missing language field set
 *
 * @package ImpressCMS\Composer\AddonInstaller\Exceptions
 */
class TranslationPackageHasUndefinedLanguageException extends RuntimeException
{

    /**
     * TranslationPackageHasUndefinedLanguageException constructor.
     *
     * @param string $packageName Package name that was tried to be installed
     * @param int $code Error code
     * @param Throwable|null $previous Previous exception
     */
    public function __construct($packageName, $code = 0, Throwable $previous = null)
    {
        parent::__construct($packageName . ' has not set language. Installation failed!', $code, $previous);
    }
}