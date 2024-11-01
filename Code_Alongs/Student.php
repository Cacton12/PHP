<?php
abstract class Person{
    protected $height;
    protected $weight;
    public function __get($property) {
        //this will return any private data member
        return $this->$property;
    }
    public function __set($property, $value) {
        $this->$property = $value;
    }
    public function __construct($height, $weight){
        $this->height = $height; //instead of $this-> might see $self->
        $this->weight = $weight;
    }
    public function toString() {
        return "Person height " . $this->height . "Person Weight " . $this->weight . "<BR>";
    }
    public abstract function myFunction();
    //an abstract class cannot be instantiated it can only be inherited 
}

class Student extends Person {
    private $id;
    private $name;
    private $DOB;

    public static $maxCourses = 10;
    public const SCHOOL ="NBCC";

    public function myFunction(){
        echo "Inside my function";
    }

    /*public function getId() {
        return $this->id;
    }
    public function setId($input) {
        $this->id = $input;
    }*/
    public function __get($property) {
        //this will return any private data member
        return $this->$property;
    }
    public function __set($property, $value) {
        $this->$property = $value;
    }

    //you can't overload the constructor in PHP, you can only have 1
    public function __construct($id, $name, $DOB, $height, $weight) {
        $this->id = $id;
        $this->name = $name;
        $this->DOB = $DOB;
        $this->height = $height;
        $this->weight = $weight;
    }//end construct
    public function __destruct() {
        //this will get called when the object goes out of scope
        //destroy any objects like DB connection, network connections, file handlers
        echo "INSIDE DESTRUCTOR<BR>";
    }

    public function toString() {
        return parent::toString() . "     STUDENT ID " . $this->id . "  NAME " . $this->name . "  DOB " . $this->DOB . "<BR>";
    }
    public static function SomeMethod() {
        echo "INSIDE STATIC METHOD<BR>";
    }//end function
}