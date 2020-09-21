<?php

	class Color {
		public $red;
		public $green;
		public $blue;
		static $verbose = false;

		public function __construct(array $kwargs){
			if (isset($kwargs['rgb'])){
				$value = intval($kwargs['rgb'], 10);
				$this->red = $value / 65536;
				$this->green = $value % 65536 / 256;
				$this->blue = $value % 65536 % 256;
			}else if (isset($kwargs['red']) && isset($kwargs['green']) && isset($kwargs['blue'])){
				$this->red = intval($kwargs['red'], 10);
				$this->green = intval($kwargs['green'], 10);
				$this->blue = intval($kwargs['blue'], 10);
			}
			if (self::$verbose){
				printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", 
				$this->red, $this->green, $this->blue);
			}
		}

		public function __toString(){
			return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", 
			$this->red, $this->green, $this->blue));
		}

		public static function doc(){
			if ($str = file_get_contents('Color.doc.txt')){
				echo "\n";
				echo "$str";
			}
		}

		public function __destruct(){
			if (self::$verbose) {
				printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", 
				$this->red, $this->green, $this->blue);
			}
		}

		public function add($arg){
			$new = new Color(array (
				'red' => $this->red + $arg->red,
				'green' => $this->green + $arg->green,
				'blue' => $this->blue + $arg->blue,
			));
			return $new;
		}

		public function sub($arg){
			$new = new Color(array (
				'red' => $this->red - $arg->red,
				'green' => $this->green - $arg->green,
				'blue' => $this->blue - $arg->blue,
			));
			return $new;
		}

		public function mult($arg){
			$new = new Color(array (
				'red' => $this->red * $arg,
				'green' => $this->green * $arg,
				'blue' => $this->blue * $arg,
			));
			return $new;
		}

	}

?>