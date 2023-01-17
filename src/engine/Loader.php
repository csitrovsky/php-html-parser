<?php


namespace src\engine;


use src\engine\actions\Web;
use src\Registry;


/**
 * @property \src\Registry $registry
 */
class Loader
{
    
    /**
     * @var string
     */
    public string $layout = 'layouts/default';
    
    /**
     * @param \src\Registry $registry
     */
    public function __construct(Registry $registry)
    {
        
        $this->registry = $registry;
    }
    
    /**
     * @param       $route
     * @param array $args
     *
     * @return void
     */
    public function controller($route, array $args = []): void { }
    
    /**
     * @param $model
     *
     * @return void
     */
    public function model($model): void { }
    
    /**
     * @param       $template
     * @param array $data
     *
     * @return string|false
     */
    public function view($template, array $data = []): string|bool
    {
        
        $path = CORE_ELEMENTS_DIR;
        $file = $path . $template . '.tpl';
        if (file_exists($file)) {
            if (count($data)) {
                extract($data, EXTR_PREFIX_SAME, 'wddx');
            }
            ob_start();
            include $file;
            
            return ob_get_clean();
        }
        exit;
    }
    
    /**
     * @param       $route
     * @param array $args
     *
     * @return false|null
     */
    public function chunks($route, array $args = []): ?bool
    {
        
        return (new Web($route, $args))->execute($this->registry);
    }
    
    /**
     * @param $library
     *
     * @return void
     */
    public function library($library): void { }
    
    /**
     * @param $helper
     *
     * @return void
     */
    public function helper($helper): void { }
}