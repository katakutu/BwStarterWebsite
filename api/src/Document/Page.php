<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Component\Routing\RouteReferrersInterface;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get"={"method"="GET", "path"="/pages/{id}", "requirements"={"id"=".+"}},
 *         "put"={"method"="PUT", "path"="/pages/{id}", "requirements"={"id"=".+"}},
 *         "delete"={"method"="DELETE", "path"="/pages/{id}", "requirements"={"id"=".+"}}
 *      },
 *     attributes={
 *          "normalization_context"={"groups"={"page"}}
 *     }
 * )
 * @PHPCR\Document(referenceable=true)
 */
class Page implements RouteReferrersInterface
{
    use ContentTrait;
}
