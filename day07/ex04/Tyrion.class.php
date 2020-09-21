<?php
    class Tyrion{
        
        public function sleepWith($arg){
            if ($arg instanceof Jaime)
                print("Not even if I'm drunk !" . PHP_EOL);
            else if ($arg instanceof Sansa)    
                print("Let's do this." . PHP_EOL);
            else if ($arg instanceof Cersei)
                print("Not even if I'm drunk !" . PHP_EOL);
        }
    }
?>