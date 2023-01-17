<?php


namespace src\records;


use RuntimeException;


/**
 * @property false|resource $handle
 */
class Logs
{
    
    /**
     * @param $filename
     */
    public function __construct($filename)
    {
        
        $this->extracted($filename);
    }
    
    /**
     * @param $filename
     *
     * @return void
     */
    public function extracted($filename): void
    {
        
        $filename = ROOT_DIR . 'logs' . DS . $filename;
        if ($filename && !is_dir(($dir = dirname($filename)))) {
            if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }
        }
        $this->handle = fopen($filename, 'ab');
    }
    
    /**
     * @param $message
     *
     * @return void
     */
    public function write($message): void
    {
        
        fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . PHP_EOL . print_r($message, true) . "\n") . PHP_EOL;
    }
    
    /**
     * @param $filename
     *
     * @return $this
     */
    public function file($filename): self
    {
        
        $this->extracted($filename);
        
        return $this;
    }
    
    /**
     *
     */
    public function __destruct()
    {
        
        fclose($this->handle);
    }
}