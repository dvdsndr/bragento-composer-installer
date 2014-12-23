<?php
/**
 * None.php
 *
 * PHP Version 5
 *
 * @category Bragento_MagentoComposerInstaller
 * @package  Bragento_MagentoComposerInstaller
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace Bragento\Magento\Composer\Installer\Deploy\Strategy;

use Bragento\Magento\Composer\Installer\Deploy\Mapping\Mappable;
use Bragento\Magento\Composer\Installer\Deploy\Mapping\MappableTrait;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class None
 *
 * @category Bragento_MagentoComposerInstaller
 * @package  Bragento\Magento\Composer\Installer\Deploy\Strategy
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class None implements Deployable, Mappable
{
    use MappableTrait;

    /**
     * deploy
     *
     * @return mixed
     */
    public function deploy()
    {
    }
}
