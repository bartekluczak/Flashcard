<?php

namespace App\DTO;

class AllSessionStatistics
{

    private $correctCount;
    private $incorrectCount;

    public function __construct($correctCount = 0, $incorrectCount = 0)
    {
        $this->correctCount = $correctCount;
        $this->incorrectCount = $incorrectCount;
    }

    
    public function getCorrectCount() : int
    {
        return $this->correctCount;
    }

    public function setCorrectCount($value)
    {
        $this->correctCount = $value;
    }

    public function getIncorrectCount() : int
    {
        return $this->incorrectCount;
    }

    public function setIncorrectCount($value)
    {
        $this->incorrectCount = $value;
    }
}