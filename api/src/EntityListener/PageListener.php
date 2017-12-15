<?php

namespace App\EntityListener;

use App\Entity\Page;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
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
     * @param Page $page
     * @ORM\PrePersist()
     */
    public function prePersist (Page $page): void
    {
        $this->setRoute($page);
    }

    /**
     * @ORM\PreUpdate()
     * @param Page $page
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate (Page $page, PreUpdateEventArgs $event): void
    {
        $routeSet = $this->setRoute($page);
        if ($routeSet || $event->hasChangedField('route')) {
            $this->updateChildRoutes($page->getChildren());
        }
    }

    private function updateChildRoutes($children, $depth = 1) {
        foreach ($children as $child) {

            $this->updateChildRoutes($child->getChildren(), $depth+1);
        }
    }

    public function setRoute(Page $page): bool
    {
        if (null === $page->getRoute())
        {
            $page->setRoute($this->slugify->slugify($page->getTitle()));
            return true;
        }
        return false;
    }
}
