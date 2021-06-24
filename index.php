<?php
class Controller{
	private $serviceProvider = false;
	private $urlSegment = false;
	
	function __construct(){
        if(!isset($_SERVER['PATH_INFO']) OR $_SERVER['PATH_INFO']=='/'){
            return;
		}

        $this->urlSegment= $_SERVER['PATH_INFO'];
		$serviceName = 'Service';
        $serviceNameFile = 'Service.php';
		
		if (file_exists($serviceNameFile)){
			require_once $serviceNameFile;
			$this->serviceProvider = new $serviceName;
		}else{
			echo 'Invlaid resource name';
		}
	}

	function run(){
		if($this->serviceProvider === false){
            echo 'Usage: index.php/{resource}/{parmeter list}';
            return;
		}

		$method =$_SERVER['REQUEST_METHOD'];
		$method =ucfirst(strtolower($method));
		$functionName ='rest'.$method;
		$this->serviceProvider->$functionName($this->urlSegment);
	}
}

$controller = new Controller();
$controller ->run();

?>