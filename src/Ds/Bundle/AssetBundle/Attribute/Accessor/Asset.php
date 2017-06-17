<?php

namespace Ds\Bundle\AssetBundle\Attribute\Accessor;

use Ds\Bundle\AssetBundle\Entity\Asset as AssetEntity;

/**
 * Trait Asset
 */
trait Asset
{
    /**
     * Set asset
     *
     * @param \Ds\Bundle\AssetBundle\Entity\Asset $asset
     * @return object
     */
    public function setAsset(AssetEntity $asset = null)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset
     *
     * @return \Ds\Bundle\AssetBundle\Entity\Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }
}
