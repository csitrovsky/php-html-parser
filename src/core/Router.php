<?php


namespace src\core;


use Exception;
use src\engine\actions\Api;
use src\engine\actions\Web;


/**
 * @property array      $methods
 * @property array      $argument
 * @property mixed|null $type
 */
class Router
{
    
    /**
     * @var bool
     */
    protected bool $_initialized = false;
    
    /**
     * @var string
     */
    private string $url = DS;
    
    /**
     * @param string $url
     * @param array  $methods
     */
    public function __construct(string $url, array $methods = [])
    {
        
        $this->url .= $url;
        $this->methods = $methods;
    }
    
    /**
     * @param string        $contextKey
     * @param               $options
     *
     * @return bool
     */
    public function initialize(string $contextKey = 'web', $options = null): bool
    {
        
        global $registry;
        
        if (!$this->_initialized) {
            if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
                $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
            }
            define('TARGET', $this->url);
            
            $this->argument = $this->explode();
            $this->type = array_shift($this->argument);
            
            try {
                switch ($this->type) {
                    case 'admin':
                        $registry->get('response')->redirect($registry->get('url')->link('error/not/found', '',
                            'SSL'));
                        $registry->get('errors')->throw('Forbidden', 403);
                        break;
                    case 'api':
                        (new Api($this->url, $registry));
                        break;
                    default:
                        $controller = $registry->get('front');
                        $registry->get('config')->load('bootstrap');
                        $routes = $registry->get('config')->get('bootstrap');
                        $routed = false;
                        $action = '';
                        foreach ($routes as $regex => $path) {
                            $matches = [];
                            if (preg_match($regex, $this->url, $matches)) {
                                $route = $path;
                                $routed = true;
                                break;
                            }
                        }
                        if (!$routed) {
                            $registry->get('response')->redirect($registry->get('url')->link('error/not/found', '',
                                'SSL'));
                            $registry->get('errors')->throw('Route does not exist', 404);
                        }
                        if ($this->type !== '') {
                            $action = (new Web($this->url));
                        } else {
                            if (empty($this->type)) {
                                $action = (new Web('home/index'));
                            } else {
                                $registry->get('errors')->throw('Not Found', 404);
                            }
                        }
                        $controller->dispatch($action, (new Web('error/not/found')));
                        break;
                }
            } catch (Exception $exception) {
                die($exception->getMessage());
            }
            
            return true;
        }
        
        return $this->_initialized;
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