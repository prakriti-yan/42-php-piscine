<?php
    require_once 'Color.class.php';
    require_once 'Vertex.class.php';
    require_once 'Vector.class.php';

    class Matrix{
        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_ratio;
        private $_near;
        private $_far;

        protected $matrix = array();
        static $verbose = FALSE;

        const IDENTITY = "IDENTITY";
        const SCALE = "SCALE";
        const RX = "Ox ROTATION";
        const RY = "Oy ROTATION";
        const RZ = "Oz ROTATION";
        const TRANSLATION = "TRANSLATION";
        const PROJECTION = "PROJECTION";

        public function __construct($arg = null){
            if (isset($arg)){
                if (isset($arg['preset']))
                    $this->_preset = $arg['preset'];
                if (isset($arg['scale']))
                    $this->_scale = $arg['scale'];
                if (isset($arg['angle']))
                    $this->_angle = $arg['angle'];
                if (isset($arg['vtc']))
                    $this->_vtc = $arg['vtc'];
                if (isset($arg['fov']))
                    $this->_fov = $arg['fov'];
                if (isset($arg['ratio']))
                    $this->_ratio = $arg['ratio'];
                if (isset($arg['near']))
                    $this->_near = $arg['near'];
                if (isset($arg['far']))
                    $this->_far = $arg['far'];
                $this->validate();
                $this->create();
                $this->chooseAction();
                if (Self::$verbose) {
                    if ($this->_preset == self::IDENTITY)
                        echo "Matrix " . $this->_preset . " instance constructed\n";
                    else
                        echo "Matrix " . $this->_preset . " preset instance constructed\n";
                }
            }
        }

        private function validate(){
            if (empty($this->_preset))
                return "Error";
            if ($this->_preset == self::SCALE && empty($this->_scale))
                return "Error";
            if (($this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ) && empty($this->angle))
                return "Error";
            if ($this->_preset == self::TRANSLATION && empty($this->_vtc))
                return "Error";
            if ($this->_preset == self::PROJECTION && (empty($this->_fov) || empty($this->_radio) || empty($this->_near) || empty($this->_far)))
                return "Error";   
        }   

        private function create(){
            for ($i = 0; $i < 16; $i++){
                $this->matrix[$i] = 0;
            }
        }

        private function chooseAction(){
            switch ($this->_preset){
                case (self::IDENTITY):
                    $this->identity(1);
                    break;
                case (self::TRANSLATION):
                    $this->translation();
                    break;
                case (self::SCALE):
                    $this->identity($this->_scale);
                    break;
                case (self::RX):
                    $this->rotateX();
                    break;
                case (self::RY):
                    $this->rotateY();
                    break;
                case (self::RZ):
                    $this->rotateZ();
                    break;
                case (self::PROJECTION):
                    $this->projection();
                    break;
            }
        }

        private function identity($s){
            $this->matrix[0] = $s;
            $this->matrix[5] = $s;
            $this->matrix[10] = $s;
            $this->matrix[15] = 1;
        }

        private function translation(){
            $this->identity(1);
            $this->matrix[3] = $this->_vtc->getX();
            $this->matrix[7] = $this->_vtc->getY();
            $this->matrix[11] = $this->_vtc->getZ();
        }

        private function rotateX(){
            $this->identity(1);
            $this->matrix[0] = 1;
            $this->matrix[5] = cos($this->_angle);
            $this->matrix[6] = -sin($this->_angle);
            $this->matrix[9] = sin($this->_angle);
            $this->matrix[10] = cos($this->_angle);
        }

        private function rotateY(){
            $this->identity(1);
            $this->matrix[0] = cos($this->_angle);
            $this->matrix[2] = sin($this->_angle);
            $this->matrix[5] = 1;
            $this->matrix[8] = -sin($this->_angle);
            $this->matrix[10] = cos($this->_angle);
        }

        private function rotateZ(){
            $this->identity(1);
            $this->matrix[0] = cos($this->_angle);
            $this->matrix[1] = -sin($this->_angle);
            $this->matrix[4] = sin($this->_angle);
            $this->matrix[5] = cos($this->_angle);
            $this->matrix[10] = 1;
        }

        private function projection(){
            $this->identity(1);
            $this->matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
            $this->matrix[0] = $this->matrix[5] / $this->_ratio;
            $this->matrix[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
            $this->matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
            $this->matrix[14] = -1;
            $this->matrix[15] = 0;
        }

        public function mult(Matrix $rhs){
            $new = array();
            for ($i=0; $i <16; $i += 4){
                for ($j=0; $j<4; $j++){
                    $new[$i + $j] = 0;
                    $new[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
                    $new[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
                    $new[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
                    $new[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
                }
            }
            $newMatrix = new Matrix();
            $newMatrix->matrix = $new;
            return $newMatrix;
        }

        public function transformVertex(Vertex $vtx)
        {
            $new = array();
            $new['x'] = ($vtx->getX() * $this->matrix[0]) + ($vtx->getY() * $this->matrix[1]) + ($vtx->getZ() * $this->matrix[2]) + ($vtx->getW() * $this->matrix[3]);
            $new['y'] = ($vtx->getX() * $this->matrix[4]) + ($vtx->getY() * $this->matrix[5]) + ($vtx->getZ() * $this->matrix[6]) + ($vtx->getW() * $this->matrix[7]);
            $new['z'] = ($vtx->getX() * $this->matrix[8]) + ($vtx->getY() * $this->matrix[9]) + ($vtx->getZ() * $this->matrix[10]) + ($vtx->getW() * $this->matrix[11]);
            $new['w'] = ($vtx->getX() * $this->matrix[11]) + ($vtx->getY() * $this->matrix[13]) + ($vtx->getZ() * $this->matrix[14]) + ($vtx->getW() * $this->matrix[15]);
            $new['color'] = $vtx->getColor();
            $vertex = new Vertex($new);
            return $vertex;
        }

        public function __toString(){
            $new = "M | vtcX | vtcY | vtcZ | vtxO\n";
            $new .= "-----------------------------\n";
            $new .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $new .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $new .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $new .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
            return (sprintf($new, $this->matrix[0], $this->matrix[1], $this->matrix[2], 
            $this->matrix[3], $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7], 
            $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11], $this->matrix[12], 
            $this->matrix[13], $this->matrix[14], $this->matrix[15]));

        }

        public static function doc(){
            if ($str = file_get_contents('Matrix.doc.txt')){
				echo "\n";
				echo "$str";
			}
        }

        public function __destruct(){
            if (Self::$verbose)
                printf("Matrix instance destructed\n");
        }
    }

?>