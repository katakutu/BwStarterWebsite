<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Component\BaseComponent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(itemOperations={
 *     "get"={"method"="GET", "path"="/pages/{id}", "requirements"={"id"=".+"}},
 *     "put"={"method"="PUT", "path"="/pages/{id}", "requirements"={"id"=".+"}},
 *     "delete"={"method"="DELETE", "path"="/pages/{id}", "requirements"={"id"=".+"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\EntityListeners({"\App\EntityListener\PageListener"})
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $metaDescription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Component\BaseComponent", mappedBy="page")
     * @var Collection
     */
    private $components;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @Groups({"layout"})
     * @var null|string
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
     * @ORM\JoinColumn(nullable=true)
     * @var null|Page
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
     * @var Collection
     */
    private $children;

    public function __construct()
    {
        $this->components = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription(string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return Collection
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    /**
     * @param array $components
     */
    public function setComponents(array $components): void
    {
        $this->components = new ArrayCollection();
        foreach ($components as $component)
        {
            $this->addComponent($component);
        }
    }

    public function addComponent(BaseComponent $component)
    {
        $this->components->add($component);
    }

    public function removeComponent(BaseComponent $component)
    {
        $this->components->removeElement($component);
    }

    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param string|null $route
     */
    public function setRoute(?string $route): void
    {
        if (null === $route) {
            $fullRoute = null;
        } else {
            $routeParts = [$route];
            $parent = $this;
            while ($parent = $parent->getParent()) {
                $routeParts[] = $parent->getRoute();
            }
            $cleanedParts = array_filter($routeParts, function($v){ return $v !== null; });
            array_reverse($cleanedParts);
            $fullRoute = '/' . join('/', $cleanedParts);
        }

        $this->route = $fullRoute;
    }

    /**
     * @return Page|null
     */
    public function getParent(): ?Page
    {
        return $this->parent;
    }

    /**
     * @param Page|null $parent
     */
    public function setParent(?Page $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param array $children
     */
    public function setChildren(array $children): void
    {
        $this->children = new ArrayCollection();
        foreach ($children as $child)
        {
            $this->addChild($child);
        }
    }

    public function addChild(Page $child)
    {
        $this->children->add($child);
    }

    public function removeChild(Page $child)
    {
        $this->children->removeElement($child);
    }
}
