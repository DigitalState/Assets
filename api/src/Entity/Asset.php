<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Association\Entity\Attribute\Accessor as AssociationAccessor;
use Ds\Component\Locale\Model\Type\Localizable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Deletable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Identitiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Tenant\Model\Attribute\Accessor as TenantAccessor;
use Ds\Component\Tenant\Model\Type\Tenantable;
use Ds\Component\Translation\Model\Attribute\Accessor as TranslationAccessor;
use Ds\Component\Translation\Model\Type\Translatable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Locale\Model\Annotation\Locale;
use Ds\Component\Translation\Model\Annotation\Translate;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Asset
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"asset_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"asset_input"}
 *          },
 *          "filters"={
 *              "app.asset.search",
 *              "app.asset.search_translation",
 *              "app.asset.date",
 *              "app.asset.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 * @ORM\Table(name="app_asset")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Asset implements Identifiable, Uuidentifiable, Ownable, Translatable, Localizable, Identitiable, Deletable, Versionable, Tenantable
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
    use TranslationAccessor\Title;
    use Accessor\Data;
    use Accessor\Deleted;
    use Accessor\Version;
    use AssociationAccessor\Associations;
    use TenantAccessor\Tenant;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"asset_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"asset_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    private $uuid;

    /**
     * @var \DateTime
     * @ApiProperty
     * @Serializer\Groups({"asset_output"})
     * @Assert\DateTime
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
    private $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    private $ownerUuid;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="identity", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $identity;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="identity_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    private $identityUuid;

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
     * @Locale
     * @Translate
     */
    private $title;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="data", type="json_array")
     * @Assert\Type("array")
     */
    private $data;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"asset_output"})
     * @ORM\OneToMany(targetEntity="App\Entity\AssetAssociation", mappedBy="asset", cascade={"persist", "remove"})
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $associations;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"asset_output", "asset_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"asset_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    private $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->data = [];
        $this->associations = new ArrayCollection;
    }
}
