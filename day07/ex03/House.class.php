<?php
    abstract class House{
        abstract public function getHouseName();
        abstract public function getHouseMotto();
        abstract public function getHouseSeat();
        public function introduce(){
            printf('House %s of %s : "%s"', $this->getHouseName(), $this->getHouseSeat(), $this->getHouseMotto());
            echo "\n";
        }
    }

?>