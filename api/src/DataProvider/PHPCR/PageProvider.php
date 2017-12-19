<?php

namespace App\DataProvider\PHPCR;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Document\Page;
use Doctrine\ODM\PHPCR\DocumentManagerInterface;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;

class PageProvider implements ItemDataProviderInterface
{
    /**
     * @var DocumentManagerInterface
     */
    private $documentManager;

    public function __construct(DocumentManagerInterface $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * @param string      $resourceClass
     * @param int|string  $id
     * @param string|null $operationName
     * @param array       $context
     *
     * @return Page|null
     * @throws ResourceClassNotSupportedException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (Page::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }
        /**
         * @var $route Route|null
         */
        $route = $this->documentManager->find(null, '/app/pages/' . $id);
        return $route;
    }
}
