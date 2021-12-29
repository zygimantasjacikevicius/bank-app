<?php

namespace  App\Form;

class Text extends Form implements InputInterface
{
    use Trait1;
    use Trait3;


    public function make(): void
    {

        echo "<input type='text' value='" . $this->value . "' name='" . $this->name . "' " . $this->makeAttributes() . " >\n";
    }
}
