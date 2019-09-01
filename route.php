<?php

class Route{
	
	private $_listUri = array();
	private $_listCall = array();

	private $_trim = '/\^$';

	public function add($uri, $function){
		$uri = trim($uri, $this->_trim);
		$this->_listUri[] = $uri;
		$this->_listCall[] = $function;
	}

	public function run($page=""){
		$uri_request = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/';
		$uri = ($page) ? $page : $uri_request;
		$uri = trim($uri, $this->_trim);

		$replacementValues = array();
		$match = false;
		foreach ($this->_listUri as $listKey => $listUri){
			
			if (preg_match("#^$listUri$#", $uri)){
				$match = true;
				
				$realUri = explode('/', $uri);
				$fakeUri = explode('/', $listUri);

				foreach ($fakeUri as $key => $value){
					if ($value == '.+'){
						$replacementValues[] = $realUri[$key];
					}
				}

				call_user_func_array($this->_listCall[$listKey], $replacementValues);
			}

		} // End of Loop

		if (!$match) {
			$this->run('404');
		}

	} // end of run

}
