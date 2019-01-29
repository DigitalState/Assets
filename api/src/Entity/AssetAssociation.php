<?php

namespace App\Entity;

use Ds\Component\Association\Entity\Association;
use App\Entity\Attribute\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AssetAssociation
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"association_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"association_input"}
 *          },
 *          "filters"={
 *              "app.asset_association.search",
 *              "app.asset_association.date"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AssetAssociationRepository")
 * @ORM\Table(name="app_asset_association")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class AssetAssociation extends Association
{
    use Accessor\Asset;

    /**
     * @var \App\Entity\Asset
     * @ApiProperty
     * @Serializer\Groups({"association_output", "association_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Asset", inversedBy="associations")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $asset;
}
