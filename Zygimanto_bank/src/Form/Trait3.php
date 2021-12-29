<?php

namespace  App\Form;

trait Trait3
{
    protected string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
