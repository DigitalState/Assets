<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Asset as AssetEntity;

/**
 * Trait Asset
 */
trait Asset
{
    /**
     * Set asset
     *
     * @param \App\Entity\Asset $asset
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
     * @return \App\Entity\Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }
}
