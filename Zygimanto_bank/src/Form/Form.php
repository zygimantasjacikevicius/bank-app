<?php

namespace  App\Form;


class Form
{

    protected array $attribute;

    public function __construct()
    {
        $this->attribute = [];
    }

    public function setAttribute(array $attribute): void
    {
        $this->attribute = $attribute;
    }

    public function makeAttributes(): string
    {
        $attributeString = '';
        foreach ($this->attribute as $key => $value) {
            if ($key !== "style") {
                $attributeString .= " $key='$value'";
            } else {
                $stileString = '';
                foreach ($value as $sKey => $sValue) {
                    $stileString .= " $sKey: $sValue;";
                }
                $attributeString .= " $key='$stileString'";
            }
        }
        return $attributeString;
    }
}
