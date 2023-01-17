<?php


const CORE_DIR = 'core';
const CORE_ENGINE_DIR = 'engine';
const CORE_LIBRARY_DIR = 'library';
const CORE_RECORDS_DIR = 'records';

return [
    'loader' => CORE_ENGINE_DIR,
    'config' => CORE_LIBRARY_DIR,
    'errors' => CORE_RECORDS_DIR,
    'url' => CORE_LIBRARY_DIR,
    'response' => CORE_LIBRARY_DIR,
    'front' => CORE_ENGINE_DIR,
    'router' => CORE_DIR,
];