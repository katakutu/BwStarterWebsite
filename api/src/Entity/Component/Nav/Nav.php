<?php

namespace App\Entity\Component\Nav;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Component\BaseComponent;
use App\Entity\Component\ComponentInterface;
use App\Entity\Layout;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity()
 */
class Nav extends BaseComponent
{
    /**
     * @ORM\OneToMany(targetEntity="NavItem", mappedBy="nav")
     * @ORM\OrderBy({"sortOrder" = "ASC"})
     * @Groups({"layout"})
     * @var ArrayCollection
     */
    private $items;

    /**
     * @ORM\OneToOne(targetEntity="NavItem", inversedBy="child")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @var null|NavItem
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="\App\Entity\Layout", mappedBy="nav")
     * @var Collection
     */
    private $layouts;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->layouts = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = new ArrayCollection();
        foreach($items as $item)
        {
            $this->addItem($item);
        }
    }

    public function addItem(NavItem $item)
    {
        $this->items->add($item);
        $item->setNav($this);
    }

    public function removeItem(NavItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * @return NavItem|null
     */
    public function getParent(): ?NavItem
    {
        return $this->parent;
    }

    /**
     * @param NavItem|null $parent
     */
    public function setParent(?NavItem $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Collection
     */
    public function getLayouts(): Collection
    {
        return $this->layouts;
    }

    /**
     * @param array $layouts
     */
    public function setLayouts(array $layouts): void
    {
        $this->layouts = new ArrayCollection();
        foreach($layouts as $layout)
        {
            $this->addLayout($layout);
        }
    }

    public function addLayout(Layout $layout)
    {
        $this->layouts->add($layout);
        $layout->setNav($this);
    }

    public function removeLayout(Layout $layout)
    {
        $this->layouts->removeElement($layout);
    }
}
