<?php

namespace ImpressCMS\Composer\AddonInstaller\LibraryInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use ImpressCMS\Composer\AddonInstaller\Exceptions\TranslationPackageHasUndefinedLanguageException;
use ImpressCMS\Composer\AddonInstaller\Utils\ImpressCMSConstantsReader;

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

        $constantsReader = new ImpressCMSConstantsReader($this->composer, $this->io);
        return $constantsReader->getConstant('ICMS_ROOT_PATH', '.') . '/language/' . $extra['language'];
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return $packageType === 'impresscms-translation';
    }

}