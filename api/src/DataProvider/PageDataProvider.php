<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Page;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PageDataProvider implements ItemDataProviderInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * PageDataProvider constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Page::class);
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
         * @var null|Page $page
         */
        $page = $this->repository->findOneBy(['route' => $id]);
        return $page;
    }
}
