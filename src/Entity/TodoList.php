<?php

namespace App\Entity;

class TodoList
{
    private int $id;
    private string $name;
    private string $description;
    private array $todos;

    public function __construct(int $id, string $name, string $description = "", array $todos = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->todos = $todos;
    }

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
}
