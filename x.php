<?php

class A {
 private $a;

  public function __construct()
  {
    $this->a = 'a';
  } 

  static public function create()
  {
     return new B();
  }
}

class B extends A {
 private $b;

  public function __construct()
  {
    parent::__construct(); 
    $this->b = 'b';
  } 
}

$x = A::create();
var_dump($x);
