<?php

namespace Maba\Bundle\GentleForceBundle\Tests\Functional\Fixtures;

use Maba\Bundle\GentleForceBundle\MabaGentleForceBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class TestKernel extends Kernel
{
    private $configFile;

    public function __construct($testCase)
    {
        parent::__construct(crc32($testCase), true);
        $this->configFile = $testCase . '.yml';
    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new SecurityBundle(),
            new MabaGentleForceBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/common.yml');
        $loader->load(__DIR__ . '/config/' . $this->configFile);
    }
}
