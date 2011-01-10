<?php

/**
 * Base test calss. The subclasses only need implement the run method.
 * 
 * @category UnitTesting
 * @package  Testes
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2010 Trey Shugart http://europaphp.org/license
 */
abstract class Testes_Benchmark_Test extends Testes_Test implements Testes_Benchmark_Benchmarkable
{
    /**
     * The results of the benchmark.
     * 
     * @return array
     */
    protected $results = array();
    
    /**
     * Runs all test methods.
     * 
     * @return Testes_Test
     */
    public function run()
    {
        $bench = array();

        // set up the current benchmarks
        $this->setUp();

        // run each benchmark
        foreach ($this->getMethods() as $test) {
            // capture start time
            $memory = memory_get_usage(true);
            $time   = microtime(true);

            // run
            $this->$test();

            // capture result
            $bench[$test] = array(
                'memory' => memory_get_usage(true) - $memory,
                'time'   => microtime(true) - $time
            );
        }

        // tear down the current benchmarks
        $this->tearDown();

        // add benchmark
        $this->results[get_class($this)] = $bench;

        return $this;
    }
    
    /**
     * Sets up the test.
     * 
     * @return void
     */
    public function setUp()
    {
        
    }
    
    /**
     * Tears down the test.
     * 
     * @return void
     */
    public function tearDown()
    {
        
    }

    /**
     * Returns the results of the benchmark.
     * 
     * @return array
     */
    public function results()
    {
        return $this->results;
    }
}