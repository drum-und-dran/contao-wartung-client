<?php

namespace DuD\ContaoWartungClientBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(\DuD\ContaoWartungClientBundle\DuDContaoWartungClientBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}
