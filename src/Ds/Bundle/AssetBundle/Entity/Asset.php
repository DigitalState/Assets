<?php

namespace Ds\Bundle\AssetBundle\Entity;

use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Translatable;
use Ds\Component\Model\Type\Identitiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Association\Attribute\Accessor as EntityAccessor;
use Knp\DoctrineBehaviors\Model as Behavior;
use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class Asset
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds.asset.search", "ds.asset.search_translation", "ds.asset.date", "ds.asset.order"},
 *          "normalization_context"={
 *              "groups"={"asset_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"asset_input"}
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\AssetBundle\Repository\AssetRepository")
 * @ORM\Table(name="ds_asset")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Asset implements Identifiable, Uuidentifiable, Ownable, Translatable, Identitiable, Versionable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Identity;
    use Accessor\IdentityUuid;
    use Accessor\Title;
    use Accessor\Data;
    use Accessor\Version;
    use EntityAccessor\Associations;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"asset_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"asset_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"asset_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"asset_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"asset_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="identity", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    protected $identity;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="identity_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $identityUuid;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Assert\All({
     *     @Assert\NotBlank,
     *     @Assert\Length(min=1)
     * })
     * @Translate
     */
    protected $title;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="data", type="json_array")
     * @Assert\Type("array")
     */
    protected $data;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty
     * @Serializer\Groups({"asset_output"})
     * @ORM\OneToMany(targetEntity="Ds\Bundle\AssetBundle\Entity\AssetAssociation", mappedBy="asset", cascade={"persist", "remove"})
     */
    protected $associations;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    protected $version;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->associations = new ArrayCollection;
    }
}
