<?php

namespace src\Entity;

use App\ORM\Annotations\ORM;

class Article
{
    #[ORM(columnType: 'AI')]
    private int $id;

    #[ORM(columnType: 'string')]
    private string $name;

    #[ORM(columnType: 'text')]
    private string $description;

    #[ORM(columnType: 'string')]
    private string $slug;

    #[ORM(relation: "ManyToOne", related: "User")]
    private User $creator;

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get the value of slug
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @param string $slug
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}
