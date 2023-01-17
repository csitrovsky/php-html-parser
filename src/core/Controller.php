<?php


namespace src\core;


use src\Registry;


/**
 * @property mixed $errors
 * @property mixed $database
 * @property mixed $config
 * @property mixed $url
 * @property mixed $logs
 * @property mixed $request
 * @property mixed $response
 * @property mixed $session
 * @property mixed $document
 * @property mixed $loader
 * @property mixed $customer
 * @property mixed $front
 * @property mixed $router
 */
class Controller
{
    
    /**
     * @var array
     */
    protected array $data = [];
    
    /**
     * @var \src\Registry
     */
    protected Registry $registry;
    
    /**
     * @var array
     */
    protected array $error = [];
    
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        
        $this->registry = $registry;
    }
    
    /**
     * @param $key
     *
     * @return mixed|void|null
     */
    public function __get($key)
    {
        
        if ($this->registry->has($key)) {
            return $this->registry->get($key);
        }
        $this->registry->get('Method not found');
    }
}