<?php


namespace src\engine;


use src\engine\actions\Web;
use src\Registry;


/**
 * @property \src\Registry           $registry
 * @property \src\engine\actions\Web $error
 */
class Front
{
    
    /**
     * @var array
     */
    private array $actions = [];
    
    /**
     * @param \src\Registry $registry
     */
    public function __construct(Registry $registry)
    {
        
        $this->registry = $registry;
    }
    
    /**
     * @param \src\engine\actions\Web $action
     * @param \src\engine\actions\Web $param
     *
     * @return void
     */
    public function dispatch(Web $action, Web $param): void
    {
        
        $this->error = $param;
        foreach ($this->actions as $item) {
            $result = $this->execute($item);
            if ($result) {
                $action = $result;
                break;
            }
        }
        while ($action) {
            $action = $this->execute($action);
        }
    }
    
    /**
     * @param mixed $action
     *
     * @return mixed
     */
    private function execute(mixed $action): mixed
    {
        
        $result = $action->execute($this->registry);
        if (is_object($result)) {
            $action = $result;
        } else {
            if ($result === false) {
                $action = $this->error;
                $this->error = '';
            } else {
                $action = false;
            }
        }
        
        return $action;
    }
}