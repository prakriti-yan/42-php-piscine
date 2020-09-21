<?php
    require_once 'Color.class.php';
     
    class Vertex{
        private $_x;
        private $_y;
        private $_z;
        private $_w = 1.0;
        private $_color;
        static $verbose = FALSE;

        public function __construct(array $kwargs){
            if (isset($kwargs['w']) && !empty($kwargs['w'])){
                $this->_w = $kwargs['w'];
            }
            if (isset($kwargs['color']) && !empty($kwargs['color']) && $kwargs['color'] instanceof Color){
                $this->_color = $kwargs['color'];
            }else{
                $this->_color = new Color(array('red'=>255, 'green'=>255, 'blue'=>255));
            }
            if (isset($kwargs['x']) && isset($kwargs['y']) && isset($kwargs['z'])){
                $this->_x = $kwargs['x'];
                $this->_y = $kwargs['y'];
                $this->_z = $kwargs['z'];
            }else{
                echo "Error!\n";
            }
            if (Self::$verbose){
                printf($this." constructed\n");
            }
        }

        public function __destruct(){
            if (Self::$verbose){
                printf($this." destructed\n");
            }
        }

        public static function doc(){
            if ($str = file_get_contents('Vertex.doc.txt')){
				echo "\n";
				echo "$str";
			}
        }

        public function __toString(){
            if (Self::$verbose){
                return (sprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )",
                $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue));
            }else{
                return (sprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", 
                $this->_x, $this->_y, $this->_z, $this->_w));
            }
        }

        public function getX(){
            return $this->_x;
        }

        public function getY(){
            return $this->_y;
        }
        public function getZ(){
            return $this->_z;
        }
        public function getW(){
            return $this->_w;
        }
        public function getColor(){
            return $this->_color;
        }
        public function setX($x){
            $this->_x = $x;
        }
        public function setY($y){
            $this->_y = $y;
        }
        public function setZ($z){
            $this->_z = $z;
        }
        public function setW($w){
            $this->_w = $w;
        }
        public function setColor($color){
            $this->_color = $color;
        }
    }
?>