<?php
    require_once 'Color.class.php';
    require_once 'Vertex.class.php';
    class Vector{
        private $_x;
        private $_y;
        private $_z;
        private $_w = 0.0;
        static $verbose = FALSE;

        public function __construct(array $kwargs){
            if(isset($kwargs['dest']) && $kwargs['dest'] instanceof Vertex){
                if(isset($kwargs['orig']) && $kwargs['orig'] instanceof Vertex){
                    $origin = new Vertex(array('x'=>$kwargs['orig']->getX(), 'y'=>$kwargs['orig']->getY(), 'z'=>$kwargs['orig']->getZ()));
                }else{
                    $origin = new Vertex(array('x'=>0, 'y'=>0, 'z'=>0));
                }
                $this->_x = $kwargs['dest']->getX() - $origin->getX();
                $this->_y = $kwargs['dest']->getY() - $origin->getY();
                $this->_z = $kwargs['dest']->getZ() - $origin->getZ();
                $this->_w = 0.0;
            }
            if (self::$verbose){
                printf($this." constructed\n");
            }
        }
        public function __toString(){
            return (sprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
        }

        public function __destruct(){
            if(self::$verbose){
                printf($this." destructed\n");
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

        public static function doc(){
            if ($str = file_get_contents('Vector.doc.txt')){
				echo "\n";
				echo "$str";
			}
        }

        public function magnitude(){
            return (float)sqrt(($this->_x * $this->_x) + ($this->_y*$this->_y) + ($this->_z*$this->_z));
        }

        public function normalize(){
            $length = $this->magnitude();
            if ($length == 1){
                return clone $this;
            }else if ($length != 0){
                $destination = new Vertex(array('x'=>$this->_x/$length, 'y'=>$this->_y/$length, 'z'=>$this->_z/$length));
                $norm = new Vector(array('dest'=>$destination));
                return $norm;
            }
        }

        public function add(Vector $rhs){
            return new Vector(array('dest'=> new Vertex(array('x'=> $this->_x + $rhs->getX(), 'y'=> $this->_y + $rhs->getY(), 'z'=> $this->_z + $rhs->getZ()))));
        }

        public function sub(Vector $rhs){
            return new Vector(array('dest'=> new Vertex(array('x'=> $this->_x - $rhs->getX(), 'y'=> $this->_y - $rhs->getY(), 'z'=> $this->_z - $rhs->getZ()))));
        }

        public function opposite(){
            return new Vector(array('dest'=> new Vertex(array('x'=> $this->_x * -1, 'y'=> $this->_y * -1, 'z'=> $this->_z * -1))));
        }

        public function scalarProduct($k){
            return new Vector(array('dest'=> new Vertex(array('x'=> $this->_x * $k, 'y'=> $this->_y * $k, 'z'=> $this->_z * $k))));
        }

        public function dotProduct(Vector $rhs){
            return (float)(($this->_x * $rhs->getX()) + ($this->_y * $rhs->getY()) + ($this->_z * $rhs->getZ()));
        }
        public function cos(Vector $rhs){
            return ((($this->_x * $rhs->getX()) + ($this->_y * $rhs->getY()) + ($this->_z * $rhs->getZ())) / sqrt((($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)) * (($rhs->getX() * $rhs->getX()) + ($rhs->getY() * $rhs->getY()) + ($rhs->getZ() * $rhs->getZ()))));
        }
        public function crossProduct(Vector $rhs){
            return new Vector(array('dest' => new Vertex(array(
                'x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(),
                'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),
                'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()))));
        }


    }
?>