<?php


namespace src\library;


use JetBrains\PhpStorm\NoReturn;
use src\Registry;


/**
 * @property \src\Registry $registry
 */
class Response
{
    
    /**
     * @var array
     */
    private array $headers = [];
    
    /**
     * @var mixed
     */
    private mixed $output;
    
    /**
     * @param \src\Registry $registry
     */
    public function __construct(Registry $registry)
    {
        
        $this->registry = $registry;
    }
    
    /**
     * @param     $url
     * @param int $status
     *
     * @return void
     */
    #[NoReturn] public function redirect($url, int $status = 302): void
    {
        
        header('Location: ' . str_replace(['&amp;', "\n", "\r"], ['&', '', ''], $url), true, $status);
        exit();
    }
    
    /**
     * @param $output
     *
     * @return void
     */
    public function set($output): void
    {
        
        $this->output = $output;
    }
    
    /**
     * @return void
     * @throws \JsonException
     */
    public function output(): void
    {
        
        if (!empty($this->output)) {
            $output = $this->output;
            if (!headers_sent()) {
                foreach ($this->headers as $header) {
                    header($header, true);
                }
            }
            echo $output;
        } else {
            $this->registry->get('errors')->throw('The page is empty');
        }
    }
    
    /**
     * @return mixed
     */
    public function get(): mixed
    {
        
        return $this->output;
    }
}