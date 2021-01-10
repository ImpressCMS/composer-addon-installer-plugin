<?php

namespace ImpressCMS\Composer\AddonInstaller\LibraryInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use ImpressCMS\Composer\AddonInstaller\Exceptions\TranslationPackageHasUndefinedLanguageException;

/**
 * Custom installer to install impresscms supported translations
 *
 * @package ImpressCMS\Composer\AddonInstaller\LibraryInstaller
 */
class TranslationInstaller extends LibraryInstaller
{

    /**
     * @inheritDoc
     */
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();

        if (!isset($extra['language'])) {
            throw new TranslationPackageHasUndefinedLanguageException(
                $package->getName()
            );
        }

        return './language/' . $extra['language'];
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return $packageType === 'impresscms-translation';
    }

}