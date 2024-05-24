<?php
declare(strict_types=1);

namespace Domain\Candidate;

use Illuminate\Support\Facades\Validator;
use Domain\Candidate\Exceptions\InvalidNameException;

class Name
{
    public function __construct(private string $value)
    {
        $this->validate($value);
    }

    private function validate()
    {
        $validator = Validator::make(['value' => $this->value], [
            'value' => ['required', 'string', 'alpha', 'min:2', 'max:255'],
        ]);

        if($validator->fails()){
            throw new InvalidNameException(implode(', ', $validator->errors()->all()));
        }
    }

    public function display()
    {
        return ucfirst(strtolower($this->value));
    }
}