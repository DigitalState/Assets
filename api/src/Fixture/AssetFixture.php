<?php

namespace App\Fixture;

use App\Fixture\Asset;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class AssetFixture
 */
final class AssetFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Asset;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/assets.yml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
