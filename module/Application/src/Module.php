<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;

class Module implements
    ConsoleBannerProviderInterface,
    ConsoleUsageProviderInterface
{
    const VERSION = '3.0.2dev';

    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }

    /**
     * This method is defined in ConsoleBannerProviderInterface.
     */
    public function getConsoleBanner(Console $console)
    {
        return 'App Module 0.0.1';
    }

    /**
     * This method is defined in ConsoleUsageProviderInterface.
     */
    public function getConsoleUsage(Console $console)
    {
        return [
            'show stats'             => 'Show application statistics',
            'run cron'               => 'Run automated jobs',
            '(enable|disable) debug' => 'Enable or disable debug mode for the application.',
        ];
    }
}
