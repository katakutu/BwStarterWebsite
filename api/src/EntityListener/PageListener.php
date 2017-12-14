<?php

namespace App\EntityListener;

use App\Entity\Page;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\Mapping as ORM;

class PageListener
{
    /**
     * @var SlugifyInterface
     */
    private $slugify;

    public function __construct(SlugifyInterface $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setRoute(Page $page)
    {
        if (null === $page->getRoute())
        {
            $page->setRoute($this->slugify->slugify($page->getTitle()));
        }
    }
}
