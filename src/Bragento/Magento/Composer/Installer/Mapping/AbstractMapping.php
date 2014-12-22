<?php
/**
 * AbstractMapping.php
 *
 * PHP Version 5
 *
 * @category  Bragento_MagentoComposerInstaller
 * @package   Bragento\Magento\Composer\Installer\Mapping
 * @author    David Verholen <david.verholen@brandung.de>
 * @copyright 2014 Brandung GmbH & Co. KG
 * @license   http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link      http://www.brandung.de
 */

namespace Bragento\Magento\Composer\Installer\Mapping;

use Bragento\Magento\Composer\Installer\Util\Filesystem;
use Bragento\Magento\Composer\Installer\Util\String;
use Composer\Package\PackageInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class AbstractMapping
 *
 * @category  Bragento_MagentoComposerInstaller
 * @package   Bragento\Magento\Composer\Installer\Mapping
 * @author    David Verholen <david.verholen@brandung.de>
 * @copyright 2014 Brandung GmbH & Co. KG
 * @license   http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link      http://www.brandung.de
 */
abstract class AbstractMapping
{
    /**
     * _mappings
     *
     * @var array
     */
    protected $mappingsArray;

    /**
     * _moduleDir
     *
     * @var SplFileInfo
     */
    private $moduleDir;

    /**
     * _fs
     *
     * @var Filesystem
     */
    private $fs;

    /**
     * _package
     *
     * @var PackageInterface
     */
    private $package;

    /**
     * construct mappings
     *
     * @param SplFileInfo      $moduleDir
     * @param PackageInterface $package
     */
    public function __construct(
        SplFileInfo $moduleDir,
        PackageInterface $package
    ) {
        $this->fs = new Filesystem();
        $this->moduleDir = $moduleDir;
        $this->package = $package;
    }

    /**
     * getTranslatedMappingsArray
     *
     * parse mappings like wildcards
     *
     * @return array
     */
    public function getResolvedMappingsArray()
    {
        return $this->resolveMappings($this->getMappingsArray());
    }

    /**
     * translateMappings
     *
     * @param array $mappings
     *
     * @return array
     */
    public function resolveMappings(array $mappings)
    {
        $translatedMap = array();
        foreach ($mappings as $src => $dest) {
            foreach (glob($this->getFs()->joinFileUris($this->getModuleDir(), $src)) as $path) {
                foreach ($this->getFinder()->in($path)->files() as $file) {
                    $fileSrc = $this->getFs()->rmAbsPathPart(
                        $file,
                        $this->getModuleDir()
                    );
                    $fileDest = $this->getFs()->joinFileUris(
                        $dest,
                        $this->getFs()->rmAbsPathPart(
                            $fileSrc,
                            $src
                        )
                    );
                    $translatedMap[$this->getFs()->trimDs($fileSrc)]
                        = $this->getFs()->trimDs($fileDest);
                }
            }
        }

        return $translatedMap;
    }

    /**
     * getFinder
     *
     * @return Finder
     */
    protected function getFinder()
    {
        return new Finder();
    }

    /**
     * getModuleDir
     *
     * @return SplFileInfo
     */
    protected function getModuleDir()
    {
        return $this->moduleDir;
    }

    /**
     * getMappingsArray
     *
     * @return array
     */
    public function getMappingsArray()
    {
        if (null === $this->mappingsArray) {
            $this->mappingsArray = $this->parseMappings();
        }

        return $this->mappingsArray;
    }

    /**
     * _pathMappingTranslations
     *
     * get the mappings from the source and return them
     *
     * * $example = array(
     * *    $source1 => $target1,
     * *    $source2 => target2
     * * )
     *
     * @return array
     */
    abstract protected function parseMappings();

    /**
     * getFs
     *
     * @return Filesystem
     */
    protected function getFs()
    {
        return $this->fs;
    }

    /**
     * getPackage
     *
     * @return PackageInterface
     */
    protected function getPackage()
    {
        return $this->package;
    }
}
