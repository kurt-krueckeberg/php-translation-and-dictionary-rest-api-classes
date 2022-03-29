<?php

class Base {
    
    
  protected function authorize()
  {
     echo "\tI am Base::authorize()\n";
  }
    
    public function __construct()
    {
       echo "Construction of Base class \n";
       $this->authorize();
    }
}

class Derived extends Base {
    
  protected function authorize()
  {
     echo "\tI am D::authorize()\n";
  }

    public function __construct()
    {
        parent::__construct();
        echo "Construction of Derived class \n";
    }
}


$obj2 = new Derived(); 
