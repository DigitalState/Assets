<?php

namespace AppBundle\Attribute\Accessor;

use AppBundle\Entity\Asset as AssetEntity;

/**
 * Trait Asset
 */
trait Asset
{
    /**
     * Set asset
     *
     * @param \AppBundle\Entity\Asset $asset
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
     * @return \AppBundle\Entity\Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }
}
