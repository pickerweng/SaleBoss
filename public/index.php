<?php
error_reporting(~0);

interface SomeInterface {}
interface SomeInterface2 {}

class Test implements SomeInterface {}
class Test2 implements SomeInterface2 {}


abstract class MyInterface
{
   public abstract function execute(SomeInterface $arg1, SomeInterface2 $arg2);
}

trait MyTrait
{
   protected function execute(SomeInterface3 $arg=null) 
   {
      echo('It works!');
   }
}

class MyClass extends MyInterface {

   use MyTrait 
   {
      execute as protected commanderExecute;
   }

   public function execute(SomeInterface $arg1, SomeInterface2 $arg2)
   {
       // do something
       $this->commanderExecute();
   }

}

$obj = new MyClass();
$obj->execute(new Test, new Test2);