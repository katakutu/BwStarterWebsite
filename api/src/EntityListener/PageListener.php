<?php

namespace App\EntityListener;

use App\Entity\Page;
use App\Entity\Route;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

class PageListener
{
    /**
     * @var SlugifyInterface
     */
    private $slugify;

    public function __construct(
        SlugifyInterface $slugify
    )
    {
        $this->slugify = $slugify;
    }

    /**
     * @param Page $page
     * @ORM\PrePersist()
     */
    public function prePersist (Page $page, LifecycleEventArgs $event): void
    {
        $this->setRoute($page, $event->getEntityManager());
    }

    /**
     * @ORM\PreUpdate()
     * @param Page $page
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate (Page $page, PreUpdateEventArgs $event): void
    {
        $routeSet = $this->setRoute($page, $event->getEntityManager());
        if ($routeSet || $event->hasChangedField('route')) {
            $this->updateChildRoutes($page->getChildren());
        }
    }

    private function updateChildRoutes($children, $depth = 1) {

        foreach ($children as $child) {

            $this->updateChildRoutes($child->getChildren(), $depth+1);
        }
    }

    public function setRoute(Page $page, EntityManagerInterface $em): bool
    {
        if (0 === $page->getRoutes()->count())
        {
            $pageRoute = $this->slugify->slugify($page->getTitle());
            $routeParts = [$pageRoute];
            $parent = $page;
            while ($parent = $parent->getParent()) {
                $routeParts[] = $parent->getRoutes()->first()->getRoute();
            }
            $cleanedParts = array_filter($routeParts, function($v){ return $v !== null; });
            array_reverse($cleanedParts);
            $route = new Route(
                '/' . join('/', $cleanedParts),
                $page
            );
            $em->persist($route);
            $page->addRoute($route);
            return true;
        }
        return false;
    }
}
