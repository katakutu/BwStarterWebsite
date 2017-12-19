<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Page;
use App\Entity\Route;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class RouteDataProvider implements ItemDataProviderInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * LayoutDataProvider constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Route::class);
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
        if (Route::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        /**
         * @var null|Route $page
         */
        $page = $this->repository->find($id);
        if ($page) {
            $page = $page->getPage();
        }
        return $page;
    }
}
