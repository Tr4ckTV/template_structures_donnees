<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    public function push(mixed $element = null): void
    {
        if (!empty($this->elements) && gettype($element) !== gettype($this->elements[0])) {
            throw new \InvalidArgumentException("Invalid element type");
        }
        $this->elements[] = $element;
    }

    public function get(int $index): mixed
    {
        if ($this->isValidIndex($index)) {
            return $this->elements[$index];
        }

        throw new \OutOfBoundsException("Invalid index: $index");
    }

    public function set(int $index, mixed $element): void
    {
        if ($this->isValidIndex($index)) {
            if (gettype($element) !== gettype($this->elements[0])) {
                throw new \InvalidArgumentException("Invalid element type");
            }
            $this->elements[$index] = $element;
        } else {
            throw new \OutOfBoundsException("Invalid index: $index");
        }
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function includes(mixed $element): bool
    {
        return in_array($element, $this->elements);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function indexOf(mixed $element): int
{
    $index = array_search($element, $this->elements, true);
    if ($index === false) {
        throw new \OutOfBoundsException("Element not found");
    }
    return $index;
}


    public function remove(int $index): void
    {
        if ($this->isValidIndex($index)) {
            array_splice($this->elements, $index, 1);
        } else {
            throw new \OutOfBoundsException("Invalid index: $index");
        }
    }

    public function size(): int
    {
        return count($this->elements);
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    protected function isValidIndex(int $index): bool
    {
        return $index >= 0 && $index < count($this->elements);
    }
}
