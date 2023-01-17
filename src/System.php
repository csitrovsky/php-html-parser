<?php


namespace src;


class System extends Autoload
{
    
    /**
     * @param false $prepend
     */
    public function register(bool $prepend = false): void
    {
        
        spl_autoload_register(function ($namespace) {
            
            $this->includes($namespace);
        }, true, $prepend);
        spl_autoload_extensions('.php');
    }
    
    /**
     * @param array $config
     *
     * @return \src\Registry
     */
    public function start(array $config = []): Registry
    {
        
        global $registry;
        $registry = (new Registry());
        foreach ($config as $key => $item) {
            $key = mb_strtolower($key);
            $src = 'src\\';
            $class = $src . ($item . '\\' . ucfirst($key));
            
            if (class_exists($class) !== true) {
                continue;
            }
            
            switch (ucfirst($key)) {
                case 'Loader':
                case 'Response':
                case 'Front':
                    $registry->set($key, (new $class($registry)));
                    break;
                case 'Router':
                    $registry->set($key, (new $class($_REQUEST['keMcQn'] ?? '')));
                    break;
                default:
                    $registry->set($key, (new $class()));
                    break;
            }
        }
        
        return $registry;
    }
}