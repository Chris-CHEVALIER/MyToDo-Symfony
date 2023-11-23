<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class TodoList
{
    private int $id;

    /**
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(
     *      min = 5, 
     *      max = 50,
     *      minMessage = "Le nom doit faire plus de 5 caractères.",
     *      maxMessage = "Le nom doit faire moins de 50 caractères."
     * )
     */
    private string $name;

    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    #[Assert\Length(min: 10, max: 200, minMessage: "La description doit faire plus de 10 caractères.", maxMessage: "La description doit faire moins de 200 caractères.")]
    private string $description;

    private array $todos;

    #[Assert\NotBlank(message: "La couleur ne peut pas être vide.")]
    private string $color;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getTodos()
    {
        return $this->todos;
    }

    public function setTodos($todos)
    {
        $this->todos = $todos;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }
}
