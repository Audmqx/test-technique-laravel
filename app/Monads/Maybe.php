<?php 
declare(strict_types=1);

namespace App\Monads;

class Maybe 
{
    private function __construct(private mixed $value) 
    {}

    public static function just(mixed $value): Maybe
    {
        return new self($value);
    }

    public static function nothing(): Maybe
    {
        return new self(null);
    }

    public function isJust(): bool
    {
        return $this->value !== null;
    }

    public function isNothing(): bool
    {
        return $this->value === null;
    }

    public function map(callable $callback): Maybe|null
    {
        if ($this->isNothing()) {
            return $this;
        }

        return self::just($callback($this->value));
    }

    public function flatMap(callable $callback): mixed
    {
        if ($this->isNothing()) {
            return $this;
        }

        return $callback($this->value);
    }

    public function getOrElse(mixed $default): mixed
    {
        if ($this->isNothing()) {
            return $default;
        }
        
        return $this->value;
    }
}