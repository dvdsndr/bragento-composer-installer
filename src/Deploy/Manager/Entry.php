<?php
/**
 * Entry.php
 *
 * PHP Version 5
 *
 * @category  Bragento_MagentoComposerInstaller
 * @package   Bragento\Magento\Composer\Installer\Deploy
 * @author    David Verholen <david.verholen@brandung.de>
 * @copyright 2014 Brandung GmbH & Co. KG
 * @license   http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link      http://www.brandung.de
 */

namespace Bragento\Magento\Composer\Installer\Deploy\Manager;

use Bragento\Magento\Composer\Installer\Deploy\Strategy\AbstractStrategy;
use Bragento\Magento\Composer\Installer\Deploy\Strategy;

/**
 * Class Entry
 *
 * @category  Bragento_MagentoComposerInstaller
 * @package   Bragento\Magento\Composer\Installer\Deploy
 * @author    David Verholen <david.verholen@brandung.de>
 * @copyright 2014 Brandung GmbH & Co. KG
 * @license   http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link      http://www.brandung.de
 */
class Entry
{
    /**
     * deployStrategy
     *
     * @var AbstractStrategy
     */
    protected $deployStrategy;

    /**
     * entry constructor
     *
     * @param Strategy\AbstractStrategy $deployStrategy deploy strategy
     */
    public function __construct(
        AbstractStrategy $deployStrategy
    ) {
        $this->deployStrategy = $deployStrategy;
    }

    /**
     * DeployStrategy
     *
     * @return AbstractStrategy
     */
    public function getDeployStrategy()
    {
        return $this->deployStrategy;
    }
}
