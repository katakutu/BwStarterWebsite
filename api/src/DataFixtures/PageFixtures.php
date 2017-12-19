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

        /**
         * LAYOUT
         */
        $layout = new Layout();
        $layout->setDefault(true);
        $manager->persist($layout);

        /**
         * MAIN NAV
         */
        $layoutNav = $this->addNav(null, $layout);

        /**
         * HOME PAGE
         */
        $page = $this->addPage(
        'Home Page',
        'Welcome to the BW Starter Website built with the best and latest frameworks. Front-end uses NuxtJS (VueJS) and Bulma. The API uses API Platform (Symfony 4).',
        '/'
    );
        $this->addNavItem($layoutNav, 'Home', 0, $page);
        $this->addHero($page, 'Homer Page', 'Doh! That\'s a typo');

        /**
         * CONTACT PAGE
         */
        $page = $this->addPage(
            'Contact',
            'This could be a contact page.'
        );
        $this->addNavItem($layoutNav, 'Contact', 2, $page);
        $this->addHero($page, 'Contactable', 'Because... why not');
        $this->addContent($page, '
        <h1>Contact Page with text</h1>
        <p>We may do this</p>
        <blockquote>We may quote something too</blockquote>
        ');

        /**
         * DOCS PAGE
         */
        $page = $this->addPage(
            'Docs',
            'Main docs page'
        );
        $docsHero = $this->addHero($page, 'Docking around the Christmas Tree', 'Have a happy holiday');

        /**
         * DOCS OVERVIEW
         */
        $docSubPage = $this->addPage(
            'Overview',
            'Overview Docs Page',
            null,
            $page
        );
        $docsNavItem = $this->addNavItem($layoutNav, 'Docs', 1, $docSubPage);

        /**
         * DOCS HERO NAV
         */
        $heroNav = $this->addNav();
        $this->addNavItem($heroNav, 'Overview', null, $docSubPage);
        $docsHero->setNav($heroNav);

        /**
         * ADD DOCS TO MAIN NAV DROP-DOWN
         */
        $docsSubNav = $this->addNav();
        $docsSubNav->setParent($docsNavItem);
        $this->addNavItem($docsSubNav, 'Docs Overview', null, $docSubPage);

        $pageTabs = $this->addNav($docSubPage);
        $this->addNavItem($pageTabs, 'Tab 1', 0, $docSubPage, 'tab1');
        $this->addNavItem($pageTabs, 'Tab 2', 1, $docSubPage, 'tab2');
        $docSubPage->addComponent($pageTabs);

        /**
         * DOCS UNDERVIEW
         */
        $docUPage = $this->addPage(
            'Underview',
            'Underview Docs Page',
            null,
            $page
        );
        $this->addNavItem($docsSubNav, 'Docs Under Sub 1', 1, $docUPage, 'fragment1');
        $this->addNavItem($docsSubNav, 'Docs Under Sub 2', 2, $docUPage, 'fragment2');
        $this->addNavItem($heroNav, 'Underview', null, $docUPage);

        $manager->flush();
    }

    private function addNavItem(Nav $nav, string $navLabel, int $order = null, Page $page = null, string $fragment = null)
    {
        if (null === $order) {
            // auto ordering
            $lastItem = $nav->getItems()->last();
            if (!$lastItem) {
                $order = 0;
            } else {
                $order = $lastItem->getSortOrder() + 1;
            }
        }

        $navItem = new NavItem();
        $navItem->setLabel($navLabel);
        $navItem->setSortOrder($order);
        $navItem->setRoute($page->getRoutes()->first());
        $navItem->setFragment($fragment);

        $nav->addItem($navItem);
        $this->manager->persist($navItem);

        return $navItem;
    }

    private function addPage(string $title, string $description, string $route = null, Page $parent = null)
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
        $page->setParent($parent);
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

    private function addNav(Page $page = null, Layout $layout = null)
    {
        $nav = new Nav();
        if ($page) {
            $nav->setPage($page);
        }
        if ($layout) {
            $nav->addLayout($layout);
        }
        $this->manager->persist($nav);
        return $nav;
    }
}
