<?php

if(empty($input)) return '';
//$params = array_filter($params);
var_dump($params);
include_once (MODX_BASE_PATH . 'assets/snippets/DocLister/lib/jsonHelper.class.php');
include_once (MODX_BASE_PATH . 'assets/snippets/Jevix/core/jevix.class.php');
if (!empty($options) && is_string($options) && $options[0] == '{') {
	$params = array_merge($params,jsonHelper::jsonDecode($options,array('assoc'=>true),true));
}
if (!isset($configDir)) {
    $configDir = 'assets/snippets/Jevix/';
} else {
    preg_match('/^(\w+)$/iu', $configDir, $configDir);
    $configDir = $configDir[1];
}
if (!isset($defaultConfig)) {
    $defaultConfig = 'default';
} else {
    preg_match('/^(\w+)$/iu', $defaultConfig, $defaultConfig);
    $defaultConfig = $defaultConfig[1];
}
$config = MODX_BASE_PATH . "{$configDir}config/{$defaultConfig}.php";
if (file_exists($config) && is_readable($config)) {
    $tmp = include($config);
} 
if (is_array($tmp)) $params = array_merge($tmp,$params);
$Jevix = new Jevix($modx, $params);
$processed = $Jevix->process($input);

if (!empty($params['escapeTags'])) {
	$processed = str_replace(
		array('[', ']', '`', '{', '}'),
		array('&#91;', '&#93;', '&#96;', '&#123;', '&#125;'),
		$processed
	);
}

return $processed;