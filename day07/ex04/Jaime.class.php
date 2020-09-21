<?php
    class Jaime{
        
        public function sleepWith($arg){
            if ($arg instanceof Tyrion)
                print("Not even if I'm drunk !" . PHP_EOL);
            else if ($arg instanceof Sansa)    
                print("Let's do this." . PHP_EOL);
            else if ($arg instanceof Cersei)
                print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
        }
    }
?>