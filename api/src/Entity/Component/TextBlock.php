<?php

namespace App\Entity\Component;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class TextBlock extends BaseComponent
{
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
