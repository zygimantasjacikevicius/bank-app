<?php

namespace  App\Form;

trait Trait1
{
    protected string $value;

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
