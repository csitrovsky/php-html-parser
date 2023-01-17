<?php


namespace api\traits;


trait Defaults
{
    
    /**
     * @param $request
     * @param $registry
     *
     * @throws \JsonException
     */
    public function __construct($request, $registry)
    {
        
        parent::__construct($request);
        $this->registry = $registry;
    }
    
    /**
     * @param $arguments
     *
     * @return mixed
     * @throws \JsonException
     */
    public function get($arguments): mixed
    {
        
        // TODO: Implement get() method.
        $this->response('Data Not Found', 400);
    }
    
    /**
     * @param $arguments
     *
     * @return mixed
     * @throws \JsonException
     */
    public function post($arguments): mixed
    {
        
        // TODO: Implement post() method.
        $this->response('Error method post', 500);
    }
    
    /**
     * @param $arguments
     *
     * @return mixed
     * @throws \JsonException
     */
    public function put($arguments): mixed
    {
        
        // TODO: Implement put() method.
        $this->response('Error method update', 400);
    }
    
    /**
     * @param $arguments
     *
     * @return mixed
     * @throws \JsonException
     */
    public function delete($arguments): mixed
    {
        
        // TODO: Implement delete() method.
        $this->response('Error method delete', 400);
    }
}