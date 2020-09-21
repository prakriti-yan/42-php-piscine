<?php
    class UnholyFactory {
        public $array;
        public function absorb($arg){
            if ($arg instanceof Fighter){
                if (isset($this->array[$arg->getName()])){
                    print("(Factory already absorbed a fighter of type " . $arg->getName(). ")" . PHP_EOL);
                }else {
                    $this->array[$arg->getName()] = $arg;
                    print("(Factory absorbed a fighter of type " . $arg->getName(). ")" . PHP_EOL);
                }   
            }else{
                print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
            }
        }
        public function fabricate($arg){
            if (isset($this->array[$arg])){
                print("(Factory fabricates a fighter of type " . $arg. ")" . PHP_EOL);
                return clone $this->array[$arg];
            }else{
                print("(Factory hasn't absorbed any fighter of type " . $arg. ")" . PHP_EOL);
                return null;
            }
        }
    }
?>