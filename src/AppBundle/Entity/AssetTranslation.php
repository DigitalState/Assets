<?php

namespace AppBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AssetTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_asset_trans")
 */
class AssetTranslation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;
}
