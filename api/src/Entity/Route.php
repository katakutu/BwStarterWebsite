<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Route
 * @package App\Entity
 * @author Daniel West <daniel@silverback.is>
 * @ORM\Entity()
 */
class Route
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @var string
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Page", inversedBy="routes")
     * @ORM\JoinColumn(fieldName="page_id", referencedColumnName="id", nullable=true)
     * @var null|Page
     */
    private $page;

    public function __construct(
        string $route = null,
        Page $page = null
    )
    {
        $this->setRoute($route);
        $this->setPage($page);
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * @return Page|null
     */
    public function getPage(): ?Page
    {
        return $this->page;
    }

    /**
     * @param Page|null $page
     */
    public function setPage(?Page $page): void
    {
        $this->page = $page;
    }

}
