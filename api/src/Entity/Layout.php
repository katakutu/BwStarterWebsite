<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Component\Nav\Nav;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"layout"}}
 *     }
 * )
 * @ORM\Entity()
 */
class Layout
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Component\Nav\Nav", inversedBy="layouts")
     * @var null|Nav
     * @Groups({"layout"})
     * @MaxDepth(5)
     */
    private $nav;

    /**
     * @ORM\Column(type="boolean", name="`default`")
     * @var bool
     */
    private $default = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return Nav|null
     */
    public function getNav(): ?Nav
    {
        return $this->nav;
    }

    /**
     * @param Nav|null $nav
     */
    public function setNav(?Nav $nav): void
    {
        $this->nav = $nav;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }

    /**
     * @param bool $default
     */
    public function setDefault(bool $default): void
    {
        $this->default = $default;
    }
}
