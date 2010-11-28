<?php

class Testes_Exception extends Exception
{
    /**
     * Thrown when an invalid test class is passed to a suite.
     * 
     * @var int
     */
    const INVALID_TEST_CLASS = 1;
    
    /**
     * Thrown when an invalid test method is passed to a test.
     * 
     * @var int
     */
    const INVALID_TEST_METHOD = 2;
}