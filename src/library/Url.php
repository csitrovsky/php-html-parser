<?php


namespace src\library;


/**
 * @property mixed $get
 * @property mixed $param
 */
class Url
{
    
    /**
     * @var array
     */
    private array $rewrite = [];
    
    /**
     * @param        $route
     * @param string $args
     * @param bool   $secure
     *
     * @return string
     */
    public function link($route, string $args = '', bool $secure = false): string
    {
        
        $url = (!$secure) ? $this->get : $this->param;
        $url .= DS . $route;
        if ($args) {
            $url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
        }
        foreach ($this->rewrite as $rewrite) {
            $url = $rewrite->rewrite($url);
        }
        
        return $url;
    }
}