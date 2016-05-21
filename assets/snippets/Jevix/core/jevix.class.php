<?php

include_once (MODX_BASE_PATH . 'assets/snippets/Jevix/core/jevix.core.php');

class Jevix extends JevixCore {
	protected $replace = array();

    protected $modx = null;
    protected $config = null;
    protected $log = array();


	/**
	 * @param DocumentParser $modx
	 * @param array $cfg;
	 */
	function __construct($modx, $cfg) {
		$this->modx = $modx;
        $this->config = $cfg;
	}

    public function log ($message = '') {
        if (!empty($message)) $this->log[] = $message;
    }


	public function process($text = '') {
		if (empty($text)) {return '';}

		$display_errors = ini_get('display_errors');
		$error_reporting = ini_get('error_reporting');

		if (!empty($this->config['debug'])) {
			ini_set('display_errors', 1);
			ini_set('error_reporting', -1);
		}
		$this->setParams($this->config);

		$errors = null;
		//$text = $this->preProcess($text);
		$text = $this->parse($text, $errors);
		//$text = $this->postProcess($text);

		if (!empty($errors) && !empty($this->config['logErrors'])) {
			$this->log('Jevix errors: ' . print_r($errors, true));
            $this->modx->logEvent(123, 3, implode('<br><br>',$this->log) , 'Jevix');
		}

		if (!empty($this->config['debug'])) {
			ini_set('display_errors', $display_errors);
			ini_set('error_reporting', $error_reporting);
		}

		return $text;
	}


	/**
	 * @param $text
	 *
	 * @return string
	 */
	public function preProcess($text) {
		return $text;
	}


	/**
	 * @param $text
	 *
	 * @return mixed
	 */
	public function postProcess($text) {
		return $text;
	}


	/**
	 * @param array $params
	 */
	public function setParams(array $params = array()) {
		// Allowed tags
		if (isset($params['cfgAllowTags'])) {
			$this->setParam('cfgAllowTags', array_map('trim', explode(',', $params['cfgAllowTags'])));
			unset($params['cfgAllowTags']);
		}

		// Other settings
		foreach ($params as $k => $v) {
			if (strpos($k, 'cfg') === false) {continue;}
			elseif (!method_exists($this, $k)) {
				$this->log('Error on Jevix init. There is no method '.$k);
				continue;
			}
			elseif (is_bool($v) || $v === '1' || $v === '0') {
				$this->setParam($k,$v);
			}
			elseif (empty($v)) {
				continue;
			}
			elseif (is_string($v) && $v[0] != '{' && $v[0] != '[') {
				$value = array_map('trim', explode(',', $v));
				$this->setParam($k, $value);
			}
			else {
				$value = jsonHelper::jsonDecode($v,array('assoc'=>true),true);
				switch ($k) {
					case 'cfgAllowTagParams':
					case 'cfgSetTagParamsRequired':
						foreach ($value as $k2 => $v2) {
							try {$this->$k($k2,$v2);}
							catch (Exception $ex) {$this->log($ex);}
						}
						break;

					case 'cfgSetAutoReplace':
					case 'cfgSetAutoPregReplace':
						if (count($value) != 2) {continue;}
						try {$this->$k($value[0], $value[1]);}
						catch(Exception $ex) {$this->log($ex);}
						break;

					case 'cfgSetTagChilds':
						foreach ($value as $tmp) {
							try {$this->$k($tmp[0], $tmp[1], $tmp[2], $tmp[3]);}
							catch(Exception $ex) {$this->log($ex);}
						}
						break;

					case 'cfgSetTagParamDefault':
						foreach ($value as $tmp) {
							try {$this->$k($tmp[0], $tmp[1], $tmp[2], $tmp[3]);}
							catch(Exception $ex) {$this->log($ex);}
						}
						break;

					default:
						$this->setParam($k, $value);
				}
			}
		}
	}


	/**
	 * @param $param
	 * @param $value
	 */
	function setParam($param, $value) {
		try {
			$this->$param($value);
		}
		catch(Exception $ex) {
			$this->log($ex);
		}
	}

}
