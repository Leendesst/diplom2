<?php

namespace App\Domain\Services;

use JsonSerializable;

class Service implements JsonSerializable
{
    
    /**
     * @var int|null
     */
    private ?int $id;
    
    /**
     * @var string
     */
    private string $title;
    
    /**
     * @var string
     */
    private string $text;
    
    /**
     * @var string
     */
    private string $image;
    
    /**
     * @param int|null $id
     * @param string $title
     * @param string $text
     * @param string $image
     */
    public function __construct(?int $id, string $title, string $text, string $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->image = $image;
    }
    
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
    
    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }
    
    /**
     * @return array
     */
    
    public function jsonSerialize(): array
    {
        return ['id' => $this->id, 'title' => $this->title, 'text' => $this->text, 'image' => $this->image,];
    }
}
