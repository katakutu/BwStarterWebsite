<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Doctrine\ODM\PHPCR\ReferrersCollection;
use Symfony\Component\Serializer\Annotation\Groups;

trait ContentTrait
{
    /**
     * @PHPCR\Id()
     * @ApiProperty(identifier=true)
     * @Groups({"page"})
     */
    protected $id;

    /**
     * @PHPCR\ParentDocument()
     */
    protected $parentDocument;

    /**
     * @PHPCR\Nodename()
     * @Groups({"page"})
     */
    protected $title;

    /**
     * @PHPCR\Field(type="string", nullable=true)
     * @Groups({"page"})
     */
    private $metaDescription;

    /**
     * @PHPCR\Referrers(
     *     referringDocument="Symfony\Cmf\Bundle\RoutingBundle\Model\Route",
     *     referencedBy="content"
     * )
     * @Groups({"page"})
     * @var ReferrersCollection
     */
    protected $routes;

    public function getId()
    {
        return $this->id;
    }

    public function getParentDocument()
    {
        return $this->parentDocument;
    }

    public function setParentDocument($parentDocument)
    {
        $this->parentDocument = $parentDocument;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function setMetaDescription($metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    public function getRoutes()
    {
        $this->routes->initialize();
        return $this->routes;
    }

    public function addRoute($route)
    {
        $this->routes->add($route);
    }

    public function removeRoute($route)
    {
        $this->routes->removeElement($route);
    }
}
