<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "list")]
class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
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
    #[ORM\Column(type: "string", unique:true)]
    private string $name;

    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    #[Assert\Length(min: 10, max: 200, minMessage: "La description doit faire plus de 10 caractères.", maxMessage: "La description doit faire moins de 200 caractères.")]
    #[ORM\Column(type: "text", nullable:true)]
    private string $description;

    #[Assert\NotBlank(message: "La couleur ne peut pas être vide.")]
    #[ORM\Column(type: "string", length: 7)]
    private string $color;

    #[ORM\Column(type: "datetime")]
    private DateTime $date;

    #[ORM\OneToMany(mappedBy: 'todoList', targetEntity: Todo::class, orphanRemoval: true)]
    private Collection $tasks;

    private int $percent = 0;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Todo>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Todo $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setTodoList($this);
        }

        return $this;
    }

    public function removeTask(Todo $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getTodoList() === $this) {
                $task->setTodoList(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of percent
     */
    public function getPercent(): int
    {
        return $this->percent;
    }

    /**
     * Set the value of percent
     */
    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }
}
