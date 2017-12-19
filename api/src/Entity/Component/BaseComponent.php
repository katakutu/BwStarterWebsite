<?php

namespace App\Entity\Component;

use App\Entity\Page;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class BaseComponent
 * @package App\Entity\Component
 * @author Daniel West <daniel@silverback.is>
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"nav" = "\App\Entity\Component\Nav\Nav", "hero" = "Hero", "content" = "Content"})
 */
abstract class BaseComponent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"page"})
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="components")
     * @var Page
     */
    private $page;

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
     * @return Page|null
     */
    public function getPage(): ?Page
    {
        return $this->page;
    }

    /**
     * @param Page $page
     */
    public function setPage(?Page $page): void
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getType()
    {
        $explCls = explode('\\', static::class);
        return array_pop($explCls);
    }
}
