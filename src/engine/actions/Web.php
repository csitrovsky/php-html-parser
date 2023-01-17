<?php


namespace src\engine\actions;


/**
 * @property string            $url
 * @property array             $argument
 * @property string            $class
 * @property mixed|string|null $method
 */
class Web
{
    
    /**
     * @var string
     */
    private string $path = '';
    
    /**
     * @var string
     */
    private string $dir = '';
    
    /**
     * @var string
     */
    private string $file = '';
    
    /**
     * @var array
     */
    private array $params = [];
    
    /**
     * @param string $url
     * @param array  $params
     */
    public function __construct(string $url, array $params = [])
    {
        
        $this->url = $url;
        $this->argument = $this->explode();
        $path = ROOT_DIR . 'controllers' . DS;
        foreach ($this->argument as $item) {
            $this->path .= $item;
            if (is_dir($path . $item)) {
                $this->path .= DS;
                $this->dir .= $item . DS;
                array_shift($this->argument);
                continue;
            }
            if (is_file($this->file = $path . $this->dir . ucfirst($item) . '.php')) {
                $this->class = 'controllers\\' . str_replace(DS, '\\', $this->dir,) . ucfirst($item);
                array_shift($this->argument);
                break;
            }
        }
        if (!empty($params)) {
            $this->params = $params;
        }
        $this->method = array_shift($this->argument);
        if (empty($this->method)) {
            $this->method = 'index';
        }
    }
    
    /**
     * @return array
     */
    private function explode(): array
    {
        
        return explode(DS, $this->trim());
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
        
        return str_replace('\\', DS, $this->url);
    }
    
    /**
     * @param $registry
     *
     * @return false|void
     */
    public function execute($registry)
    {
        
        if (str_starts_with($this->method, '__')) {
            return false;
        }
        if (is_file($this->file)) {
            $class = $this->class;
            if (!class_exists($class)) {
                $registry->get('error')->throw('Not Found', 404);
            }
            $controller = (new $class($registry));
            if (is_callable([$controller, $this->method])) {
                return $controller->{$this->method}($this->params);
            }
        }
        $registry->get('errors')->throw('Not Found', 404);
    }
}