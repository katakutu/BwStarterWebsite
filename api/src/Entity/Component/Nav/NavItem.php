<?php

namespace App\Entity\Component\Nav;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Page;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity()
 */
class NavItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Nav", inversedBy="items")
     * @var Nav
     */
    private $nav;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Page")
     * @ORM\JoinColumn(fieldName="page_id", referencedColumnName="id", nullable=true)
     * @Groups({"layout"})
     * @var null|Page
     */
    private $page;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"layout"})
     * @var null|string
     */
    private $fragment;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"layout"})
     * @var int
     */
    private $sortOrder;

    /**
     * @ORM\OneToOne(targetEntity="Nav", mappedBy="parent")
     * @Groups({"layout"})
     * @var null|Nav
     */
    private $child;

    /**
     * @ORM\Column(type="string")
     * @Groups({"layout"})
     * @var string
     */
    private $label;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Nav
     */
    public function getNav(): Nav
    {
        return $this->nav;
    }

    /**
     * @param Nav $nav
     */
    public function setNav(Nav $nav): void
    {
        $this->nav = $nav;
    }

    /**
     * @return null|Page
     */
    public function getPage(): ?Page
    {
        return $this->page;
    }

    /**
     * @param null|Page $page
     */
    public function setPage(Page $page = null): void
    {
        $this->page = $page;
    }

    /**
     * @return null|string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * @param null|string $fragment
     */
    public function setFragment(?string $fragment): void
    {
        $this->fragment = $fragment;
    }

    /**
     * @return int
     */
    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     */
    public function setSortOrder(int $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return Nav|null
     */
    public function getChild(): ?Nav
    {
        return $this->child;
    }

    /**
     * @param Nav|null $child
     */
    public function setChild(?Nav $child): void
    {
        $this->child = $child;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }
}
