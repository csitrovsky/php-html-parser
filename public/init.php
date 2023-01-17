<?php


use src\Autoload;


const DS = DIRECTORY_SEPARATOR;
define("ROOT_DIR", dirname(__DIR__, 1) . DS);

const CORE_API_DIR = ROOT_DIR . 'api' . DS;
const CORE_CONFIG_DIR = ROOT_DIR . 'config' . DS;
const CONFIG_KEY = 'config.';
const CORE_PUBLIC_DIR = ROOT_DIR . 'public' . DS;
const CORE_ELEMENTS_DIR = CORE_PUBLIC_DIR . 'elements' . DS;
const CORE_LAYOUTS_DIR = CORE_ELEMENTS_DIR . 'layouts' . DS;
const CORE_TEMPLATES_DIR = CORE_ELEMENTS_DIR . 'templates' . DS;
const CORE_SRC_DIR = ROOT_DIR . 'src' . DS;

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

session_cache_limiter(false);
session_start();

$includes = [
    'bootstrap' => CORE_CONFIG_DIR . CONFIG_KEY . 'bootstrap',
    'core' => CORE_CONFIG_DIR . CONFIG_KEY . 'core',
    'autoload' => CORE_SRC_DIR . 'Autoload',
];

try {
    if (count($includes) > 0) {
        foreach ($includes as $variable => $file) {
            if (!file_exists(($file .= '.php'))) {
                throw new RangeException("File not found [$variable]: $file");
            }
            $$variable = include $file;
        }
    } else {
        throw new RuntimeException('Unable to generate a page');
    }
} catch (Exception $exception) {
    die($exception->getMessage());
}

$autoload = (new Autoload());
if (!is_object($autoload)) {
    ob_get_level() && @ob_end_flush();
    exit();
}

return $autoload->engine('web')->start($core ?? []);