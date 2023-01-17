<?php


namespace src;


/**
 * @property $namespace
 */
class Autoload
{
    
    /**
     * @var System|null
     */
    private ?System $method = null;
    
    /**
     * @var string
     */
    private string $location;
    
    /**
     * @return \src\System|null
     */
    public function engine(): ?System
    {
        
        if (!is_null($this->method)) {
            return $this->method;
        }
        spl_autoload_register($callback = [$this, 'includes'], false, false);
        $this->method = $method = (new System());
        spl_autoload_unregister($callback);
        $method->register(true);
        
        return $method;
    }
    
    /**
     * @param $namespace
     *
     * @return void
     */
    protected function includes($namespace): void
    {
        
        if (!is_null(($this->namespace = $namespace))) {
            $this->attach_a_file();
        }
    }
    
    /**
     * @return void
     */
    private function attach_a_file(): void
    {
        
        if ($this->check_file_exists()) {
            require_once $this->location;
        }
    }
    
    /**
     * @return bool
     */
    private function check_file_exists(): bool
    {
        
        $this->location = $this->converter_filename();
        
        return file_exists($this->location);
    }
    
    /**
     * @return string
     */
    private function converter_filename(): string
    {
        
        return $this->location();
    }
    
    /**
     * @return string
     */
    private function location(): string
    {
        
        return ROOT_DIR . $this->trim() . '.php';
    }
    
    /**
     * @return string
     */
    private function trim(): string
    {
        
        return trim($this->str_replace(), DS);
    }
    
    /**
     * @return array|string
     */
    private function str_replace(): array|string
    {
        
        return str_replace('\\', DS, $this->namespace);
    }
}