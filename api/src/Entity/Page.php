<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Component\BaseComponent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\EntityListeners({"\App\EntityListener\PageListener"})
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="route_unique",columns={"parent_id", "route"})})
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", nullable=true)
     * @var null|string
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="Page")
     * @ORM\JoinColumn(nullable=true)
     * @var null|Page
     */
    private $parent;

    public function __construct()
    {
        $this->components = new ArrayCollection();
    }

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
        $this->route = $route;
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
     * @Groups({"layout"})
     * @return string
     */
    public function getFullRoute()
    {
        $routeParts = [$this->getRoute()];
        $parent = $this;
        while ($parent = $parent->getParent()) {
            $routeParts[] = $parent->getRoute();
        }
        array_reverse($routeParts);
        return '/' . join('/', array_filter($routeParts, function($v){ return $v !== null; }));
    }
}
