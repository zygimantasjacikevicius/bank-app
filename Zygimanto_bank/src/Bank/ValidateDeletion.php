<?php

namespace  App\Bank;

class ValidateDeletion
{
    private string $errDeletion;


    public function __construct()
    {
        $this->errDeletion = "";
    }

    public function getErrDeletion(): string
    {
        return $this->errDeletion;
    }



    function validateBalance(int $balance): void
    {

        if ($balance > 0) {
            $this->errDeletion = "SĄSKAITOS SU LĖŠOMIS IŠTRINTI NEGALIMA";
        }
    }
}
