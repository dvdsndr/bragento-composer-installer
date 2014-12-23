<?php
/**
 * DITest.php
 *
 * PHP Version 5
 *
 * @category Bragento_MagentoComposerInstaller
 * @package  Bragento_MagentoComposerInstaller
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace Bragento\Test\Magento\Composer\Installer;

use Bragento\Magento\Composer\Installer\App;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\IO\NullIO;
use Composer\Package\RootPackage;

/**
 * Class DITest
 *
 * @category Bragento_MagentoComposerInstaller
 * @package  Bragento\Test\Magento\Composer\Installer
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class DITest extends \PHPUnit_Framework_TestCase
{
    const NS = 'Bragento\\Magento\\Composer\\Installer\\';

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

    }

    public function testDependencyInjection()
    {
        $composer = $this->getDummyComposer();
        $io = $this->getDummyIOInterface();

        App::init($composer, $io);
        $deployService = App::getDeployService();
        $config = App::getConfig();
        $mappingLoader = App::getMappingLoader();
        $strategyLoader = App::getStrategyLoader();

        $this->assertSame($composer, $deployService->getComposer());
        $this->assertSame($io, $deployService->getIOInterface());
        $this->assertSame($config, App::getConfig());
        $this->assertSame($mappingLoader, App::getMappingLoader());
        $this->assertSame($strategyLoader, App::getStrategyLoader());

        $this->assertInstanceOf('Composer\\Composer', $deployService->getComposer());
        $this->assertInstanceOf('Composer\\IO\\IOInterface', $deployService->getIOInterface());
        $this->assertInstanceOf(self::NS . 'Config\\Composer', App::getConfig());
        $this->assertInstanceOf(self::NS . 'Deploy\\Mapping\\Loader', App::getMappingLoader());
        $this->assertInstanceOf(self::NS . 'Deploy\\Strategy\\Loader', App::getStrategyLoader());
    }

    /**
     * getDummyIOInterface
     *
     * @return IOInterface
     */
    protected function getDummyIOInterface()
    {
        return new NullIO();
    }

    /**
     * getDummyComposer
     *
     * @param array $extra
     *
     * @return Composer
     */
    protected function getDummyComposer(array $extra = [])
    {
        $composer = new Composer();
        $composer->setPackage($this->getDummyRootPackage($extra));

        return $composer;
    }

    /**
     * getDummyRootPackage
     *
     * @param array $extra
     *
     * @return RootPackage
     */
    protected function getDummyRootPackage(array $extra = [])
    {
        $package = new RootPackage('rootpackage', '1.0.0', '1.0.0');
        $package->setExtra($extra);

        return $package;
    }
}
