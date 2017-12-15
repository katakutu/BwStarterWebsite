<?php

namespace App\DataFixtures;

use App\Entity\Component\Hero;
use App\Entity\Component\Nav\Nav;
use App\Entity\Component\Nav\NavItem;
use App\Entity\Layout;
use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use  Doctrine\Common\DataFixtures\Purger;
class PageFixtures extends Fixture
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $layout = new Layout();
        $layout->setDefault(true);
        $manager->persist($layout);

        $nav = new Nav();
        $nav->addLayout($layout);
        $manager->persist($nav);

        $page = $this->addPage(
        'Home Page',
        'Welcome to the BW Starter Website built with the best and latest frameworks. Front-end uses NuxtJS (VueJS) and Bulma. The API uses API Platform (Symfony 4).',
        ''
    );
        $this->addNavItem($nav, 'Home', 0, $page);
        $hero = new Hero();
        $hero->setPage($page);
        $hero->setTitle('Home Page');
        $hero->setSubtitle('All about the home diddly-home');
        $manager->persist($hero);

        $page = $this->addPage(
            'Contact',
            'This could be a contact page.'
        );
        $this->addNavItem($nav, 'Contact', 2, $page);

        $page = $this->addPage(
            'Docs',
            'Main docs page'
        );
        $docsNavItem = $this->addNavItem($nav, 'Docs', 1, $page);

        $docsSubNav = new Nav();
        $docsSubNav->setParent($docsNavItem);
        $manager->persist($docsSubNav);
        $this->addNavItem($docsSubNav, 'Docs Sub 1', 0, $page, 'fragment1');
        $this->addNavItem($docsSubNav, 'Docs Sub 2', 1, $page, 'fragment2');


        $manager->flush();
    }

    private function addNavItem(Nav $nav, string $navLabel, int $order = 0, Page $page = null, string $fragment = null)
    {

        $navItem = new NavItem();
        $navItem->setLabel($navLabel);
        $navItem->setSortOrder($order);
        $navItem->setPage($page);
        $navItem->setFragment($fragment);

        $nav->addItem($navItem);
        $this->manager->persist($navItem);

        return $navItem;
    }

    private function addPage(string $title, string $description, string $route = null)
    {
        $page = new Page();
        $page->setTitle($title);
        $page->setMetaDescription($description);
        $page->setRoute($route);

        $this->manager->persist($page);

        return $page;
    }
}
