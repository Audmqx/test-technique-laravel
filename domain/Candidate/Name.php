<?php
declare(strict_types=1);

namespace Domain\Candidate;

class Name
{
    public function __construct(private string $value)
    {
    }

    public function display()
    {
        return $this->value;
    }
}