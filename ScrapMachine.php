<?php

namespace cacharreoGeek {
    Class ScrapMachine {
        public $pathEngines = './engines/';
        private $engines = array();
        public function __construct() {
            $this->loadEngines();
        }
        private function loadEngines() {
            $dir_list = preg_grep('/^([^.])/', scandir($this->pathEngines));
            //$dir_list = scandir($this->pathEngines);
            foreach($dir_list as $engine){
                $engine = str_replace('.php','',$engine);
                $this->loadEngine($engine);
            }
        }
        private function loadEngine($engine){
            require($this->pathEngines.$engine.".php");
            $data_engine = array(
                'steps' => $steps,
                'variables' => $variables
            );
            
            $this->engines[$engine] = $data_engine;
        }
        public function startDownloads($keyword){
            foreach($this->engines as $engine => $data_engine){
                $this->downloadPage($keyword, $engine);
                //var_export($data_engine);
                die();
            }
            return $this;
        }
        public function downloadPage($keyword, $engine) {
            $_ = $this->engines[$engine];
            $steps = $_['steps'];
            $variables = $_['variables'];
            $path = str_replace('{{search}}',urlencode($keyword),$variables['path']);
            
            
            $result = $this->curl($path, $variables['method']);
            $total_steps = count($steps);
            for($i=0;$i<$total_steps;$i++){
                $step_function = $steps[$i];
                $result = $step_function($result);
            }
            
            var_export($result);
            //$parts = parse_url($path, PHP_URL_HOST);
            //var_export($parts);
            //var_export($parts);
            //$engine = $parts['0'];
            //$this->loadEngine($engine);
            return $this;
        }
        private function curl($path,$method){
            
            //cache for few hours???
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $path);

            if($method == 'POST'){
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");
                //http_build_query(array('postvar1' => 'value1')));
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);
            return $server_output;
        }
    }

    Class searchMachine {
        private $what2search;
        private $machine;
        public function __construct($object) {
            $this->what2search=$object;
            $this->machine = new ScrapMachine();
        }
        public function init() {
            $this->machine->startDownloads($this->what2search);
        }
        public function single($keyword, $engine){
            $this->machine->downloadPage($keyword, $engine);
        }
    }
}

?>