<?php

namespace App\Stat\Asset;

use App\Service\AssetService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
final class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \App\Service\AssetService
     */
    private $assetService;

    /**
     * Constructor
     *
     * @param \App\Service\AssetService $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): Datum
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->assetService->getRepository()->getCount([]));

        return $datum;
    }
}
