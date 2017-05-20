<?php

namespace Ds\Bundle\AssetBundle\Entity;

use Ds\Component\Model\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AssetTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_asset_translation")
 */
class AssetTranslation
{
    use Behavior\Translatable\Translation;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;
}
