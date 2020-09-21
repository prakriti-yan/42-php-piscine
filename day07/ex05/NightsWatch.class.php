<?php
    class NightsWatch implements IFighter{
        public $array;
        public function fight(){
            foreach ($this->array as $fighter){
                $fighter->fight();
            }
        }
        public function recruit($arg){
            if ($arg instanceof IFighter){
                $this->array[] = $arg;
            }
        }
    }
?>