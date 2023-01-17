<?php


namespace src\engine\actions;


/**
 * @property string     $url
 * @property array      $argument
 * @property mixed|null $type
 * @property string     $class
 */
class Api
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
     * @param string $url
     * @param        $registry
     */
    public function __construct(string $url, $registry)
    {
        
        $this->url = $url;
        $this->argument = $this->explode();
        $this->type = array_shift($this->argument);
        $this->class = '';
        if (!count($this->argument)) {
            $registry->get('errors')->throw('There is no api method', 400);
        }
        $path = CORE_API_DIR . 'methods' . DS;
        foreach ($this->argument as $item) {
            $this->path .= $item;
            if (is_dir($path . $item)) {
                $this->path .= DS;
                $this->dir .= $item . DS;
                array_shift($this->argument);
                continue;
            }
            if (is_file($path . $this->dir . ucfirst($item) . '.php')) {
                $this->class = "$this->type\methods\\" . str_replace(
                        DS,
                        '\\',
                        $this->dir,
                    ) . ucfirst($item);
                array_shift($this->argument);
                break;
            }
        }
        if (class_exists($this->class)) {
            if (!count($this->argument)) {
                $registry->get('errors')->throw('Request is empty', 400);
            }
            die((new $this->class(implode(DS, $this->argument), $registry))->process());
        }
        $registry->get('errors')->throw('There is no api method', 400);
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
}