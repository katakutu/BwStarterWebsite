<?php

namespace App\DataFixtures\PHPCR;

use App\Document\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;

class PageFixtures implements FixtureInterface
{
    public function load(ObjectManager $dm)
    {
        if (!$dm instanceof DocumentManager) {
            $class = get_class($dm);
            throw new \RuntimeException("Fixture requires a PHPCR ODM DocumentManager instance, instance of '$class' given.");
        }

        $parent = $dm->find(null, '/app/pages');

        $page = new Page();
        $page->setTitle('Home');
        $page->setParentDocument($parent);
        $page->setMetaDescription('Welcome to the homepage of this really website.');

        $dm->persist($page);
        $dm->flush();
    }
}
