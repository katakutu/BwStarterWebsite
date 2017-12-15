<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Layout;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class LayoutDataProvider implements ItemDataProviderInterface
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
        $this->repository = $em->getRepository(Layout::class);
    }

    /**
     * @param string      $resourceClass
     * @param int|string  $id
     * @param string|null $operationName
     * @param array       $context
     *
     * @return Layout|null
     * @throws ResourceClassNotSupportedException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (Layout::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        /**
         * @var null|Layout $layout
         */
        $layout = $id === 'default' ? $this->repository->findOneBy(['default' => true]) : $this->repository->find($id);
        return $layout;
    }
}
