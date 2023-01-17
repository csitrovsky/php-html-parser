<?php


namespace controllers;


use src\core\Controller;
use src\core\Defaults;


class Home extends Controller
{
    
    use Defaults;
    
    
    /**
     * @return void
     */
    public function index(): void
    {
        
        $this->response->set($this->loader->view($this->loader->layout, $this->data));
    }
}