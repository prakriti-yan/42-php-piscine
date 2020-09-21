<?php
    class Fighter{
        private $_name;
        public function __construct($arg){
            $this->_name = $arg;
        }

        public function getName(){
            return $this->_name;
        }
    }
?>