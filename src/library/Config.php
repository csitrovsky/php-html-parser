<?php


namespace src\library;


class Config
{
    
    /**
     * @var array
     */
    private array $data = [];
    
    /**
     * @param $key
     *
     * @return mixed|null
     */
    public function get($key): mixed
    {
        
        return ($this->data[$key] ?? null);
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
    
    /**
     * @param $filename
     *
     * @return void
     */
    public function load($filename): void
    {
        
        $file = CORE_CONFIG_DIR . CONFIG_KEY . "$filename.php";
        if (file_exists($file)) {
            $_[$filename] = require($file);
            $this->data = array_merge($this->data, $_);
        } else {
            trigger_error('Error: Could not load config ' . $filename . '!');
            exit();
        }
    }
}