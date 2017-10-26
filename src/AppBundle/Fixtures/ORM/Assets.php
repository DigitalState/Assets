<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\AssetFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Assets
 */
class Assets extends AssetFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/assets.yml';
    }
}
