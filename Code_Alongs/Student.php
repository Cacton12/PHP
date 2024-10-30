<?php
class Student {
    public $id;
    public $name;
    public $DOB;

    public function __get($Property) {
        //this will return any private data member
        return $this->$Property;
    }

    public function __set($Property, $value) {
        $this->$Property = $value;
    }

    public function __construct($id, $name, $DOB) {
        $this->id = $id;
        $this->name = $name;
        $this->DOB = $DOB;
    }

    public function destruct() {
        //destroy any objects like DB connection, network connections, file handlers
        echo "<br>Object destroyed";
    }

    public function toString() {
        return "Student ID " . $this->id . " NAME " . $this->name . " DOB " . $this->DOB . "<br>";
    }

}