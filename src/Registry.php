<?php


namespace src;


class Registry
{
    
    /**
     * @var array
     */
    private array $data = [];
    
    /**
     *
     */
    public function __construct() { }
    
    /**
     * @param $key
     *
     * @return mixed|null
     */
    public function get($key): mixed
    {
        
        return ($this->data[mb_strtolower($key)] ?? null);
    }
    
    /**
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function set($key, $value): void
    {
        
        $this->data[$key] = $value;
    }
    
    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        
        return isset($this->data[$key]);
    }
}