<?php
    class Targaryen{
        public function resistsFire() {
            return FALSE;
        }

        public function getBurned(){
            $resist = static::resistsFire();
            if ($resist){
                return "emerges naked but unharmed";
            }else{
                return "burns alive";
            }
        }
    }
?>