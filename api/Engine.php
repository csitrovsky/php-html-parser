<?php


namespace api;


/**
 * @property                   $registry
 * @property                   $request
 * @property array             $arguments
 * @property mixed|null        $verb
 * @property mixed             $method
 * @property mixed             $contents
 */
abstract class Engine implements Controller
{
    
    /**
     * @var array|object|string[]
     */
    protected array|object $results = [
        'results' => 'Empty response',
    ];
    
    /**
     * @param $request
     *
     * @throws \JsonException
     */
    public function __construct($request)
    {
        
        $this->request = $request;
        $this->arguments = $this->explode();
        if ($this->array_key_exists($this->arguments) &&
            !is_numeric($this->arguments[0])) {
            $this->verb = array_shift($this->arguments);
        }
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method === 'POST' &&
            $this->array_key_exists($_SERVER, 'HTTP_X_HTTP_METHOD')) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] === 'DELETE') {
                $this->method = 'DELETE';
            } else {
                if ($_SERVER['HTTP_X_HTTP_METHOD'] === 'PUT') {
                    $this->method = "$this->method = \"PUT\";";
                } else {
                    $this->response('Unexpected Header', 500);
                }
            }
        }
    }
    
    /**
     * @return array
     */
    private function explode(): array
    {
        
        return explode(DIRECTORY_SEPARATOR, $this->trim());
    }
    
    /**
     * @return string
     */
    private function trim(): string
    {
        
        return trim($this->str_replace(), DIRECTORY_SEPARATOR);
    }
    
    /**
     * @return array|object|string
     */
    private function str_replace(): array|object|string
    {
        
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->request);
    }
    
    /**
     * @param array      $array
     * @param int|string $key
     *
     * @return bool
     */
    private function array_key_exists(array $array, int|string $key = 0): bool
    {
        
        return array_key_exists($key, $array);
    }
    
    /**
     * @param     $message
     * @param int $code
     *
     * @return false|string
     * @throws \JsonException
     */
    public function response($message, int $code = 200): bool|string
    {
        
        $this->registry->get('errors')->headers();
        if ($code !== 200) {
            $this->registry->get('errors')->throw($message, $code);
        }
        
        return $this->registry->get('errors')->output($message, $code);
    }
    
    /**
     * @return bool|string
     * @throws \JsonException
     */
    public function process(): bool|string
    {
        
        switch ($this->method) {
            case 'GET':
                $this->request = (object)$this->clean_inputs($_GET);
                break;
            case 'DELETE':
            case 'POST':
                $this->request = (object)$this->clean_inputs($_POST);
                $this->contents = $this->input();
                break;
            case 'PUT':
                $this->request = (object)$this->clean_inputs($_GET);
                $this->contents = $this->input();
                break;
            default:
                $this->response('Invalid Method', 405);
                break;
        }
        if (method_exists($this, $this->method)) {
            return $this->response($this->{$this->method}($this->request));
        }
        
        return $this->response("No Endpoint: $this->method...", 404);
    }
    
    /**
     * @param $data
     *
     * @return array|string
     */
    private function clean_inputs($data): array|string
    {
        
        $clean_input = [];
        if (!is_array($data)) {
            $clean_input = trim(strip_tags((string)$data));
        } else {
            foreach ($data as $key => $value) {
                $clean_input[$key] = $this->clean_inputs($value);
            }
        }
        
        return $clean_input;
    }
    
    /**
     * @return mixed
     * @throws \JsonException
     */
    private function input(): mixed
    {
        
        $contents = file_get_contents('php://input') ?: '{}';
        
        return json_decode(
            $contents,
            true,
            512,
            JSON_THROW_ON_ERROR,
        );
    }
}