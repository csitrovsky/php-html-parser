<?php


namespace controllers\error;


use src\core\Controller;
use src\core\Defaults;


class Not extends Controller
{
    
    use Defaults;
    
    
    public function found(): void
    {
        
        $this->loader->layout = 'layouts/errors';
        $this->response->set($this->loader->view($this->loader->layout, $this->data));
    }
}