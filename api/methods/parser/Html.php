<?php


namespace api\methods\parser;


use api\Engine;
use api\traits\Defaults;


class Html extends Engine
{
    
    use Defaults;
    
    
    /**
     * @param $arguments
     *
     * @return object
     * @throws \JsonException
     */
    public function post($arguments): object
    {
        
        if (!array_key_exists('url', (array)$this->contents)) {
            $this->response('Вы не передали ссылку', 400);
        }
        $url = $this->contents['url'];
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->response('Строка не является ссылкой', 400);
        }
        $html = file_get_contents($url);
        $search = preg_match_all('/<([^\/!][a-z1-9]*)/i', $html, $matches);
        $html = array_count_values(next($matches));
        if (count($html) <= 0) {
            $this->response('Страница пуста', 400);
        }
        
        return (object)$this->results = ['tags' => $html];
    }
}