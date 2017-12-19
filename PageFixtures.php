<?php

namespace App\DataFixtures;

use App\Entity\Component\Hero;
use App\Entity\Component\Nav\Nav;
use App\Entity\Component\Nav\NavItem;
use App\Entity\Component\Content;
use App\Entity\Layout;
use App\Entity\Page;
use App\Entity\Route;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\Purger;

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
        '/'
    );
        $this->addNavItem($nav, 'Home', 0, $page);
        $homeHero = $this->addHero($page, 'Homer Page', 'Doh! That\'s a typo');

        $page = $this->addPage(
            'Contact',
            'This could be a contact page.'
        );
        $this->addNavItem($nav, 'Contact', 2, $page);
        $this->addHero($page, 'Contactable', 'Because... why not');
        $this->addContent($page, '
        <h1>Contact Page with text</h1>
        <p>We may do this</p>
        <blockquote>We may quote something too</blockquote>
        ');

        $page = $this->addPage(
            'Docs',
            'Main docs page'
        );
        $docsNavItem = $this->addNavItem($nav, 'Docs', 1, $page);
        $this->addHero($page, 'Docking around the Christmas Tree', 'Have a happy holiday');

        $docsSubNav = new Nav();
        $docsSubNav->setParent($docsNavItem);
        $manager->persist($docsSubNav);

        $docSubPage = $this->addPage(
            'Overview',
            'Overview Docs Page'
        );
        $docSubPage->setParent($page);
        $this->addNavItem($docsSubNav, 'Docs Overview', 0, $docSubPage);
        $this->addNavItem($docsSubNav, 'Docs Sub 1', 1, $docSubPage, 'fragment1');
        $this->addNavItem($docsSubNav, 'Docs Sub 2', 2, $docSubPage, 'fragment2');

        $heroNav = new Nav();
        $manager->persist($heroNav);
        $this->addNavItem($heroNav, 'Docs', 1, $page);
        $homeHero->setNav($heroNav);

        $manager->flush();
    }

    private function addNavItem(Nav $nav, string $navLabel, int $order = 0, Page $page = null, string $fragment = null)
    {

        $navItem = new NavItem();
        $navItem->setLabel($navLabel);
        $navItem->setSortOrder($order);
        $navItem->setRoute($page->getRoutes()->first());
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
        if (null !== $route) {
            $route = new Route(
                $route,
                $page
            );
            $this->manager->persist($route);
            $page->addRoute($route);
        }

        $this->manager->persist($page);

        return $page;
    }

    private function addHero(Page $page, string $title, string $subtitle = null)
    {
        $hero = new Hero();
        $hero->setPage($page);
        $hero->setTitle($title);
        $hero->setSubtitle($subtitle);
        $this->manager->persist($hero);
        return $hero;
    }

    private function addContent(Page $page, string $content)
    {
        $textBlock = new Content();
        $textBlock->setPage($page);
        $textBlock->setContent($content);
        $this->manager->persist($textBlock);
        return $textBlock;
    }
}
