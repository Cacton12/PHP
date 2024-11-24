<?php
class users
{
    private $userId;
    private $Password;
    private $LastName;
    private $Province;
    private $ContactNo;
    private $DateAdded;
    private $Location;
    private $url;
    private $UserName;
    private $FirstName;
    private $Address;
    private $postalCode;
    private $email;
    private $profImage;
    private $description;

    public function __get($property)
    {
        // This will return any private data member
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    // Constructor with parameters for initializing user properties
    public function __construct($userId, $Password, $FirstName, $LastName, $UserName, $email, $ContactNo, $Address, $postalCode, $Province, $Location, $profImage, $description, $url)
    {
        $this->userId = $userId;
        $this->Password = $Password;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->UserName = $UserName;
        $this->email = $email;
        $this->ContactNo = $ContactNo;
        $this->Address = $Address;
        $this->postalCode = $postalCode;
        $this->Province = $Province;
        $this->Location = $Location;
        $this->profImage = $profImage;
        $this->description = $description;
        $this->url = $url;
        $this->DateAdded = date("Y-m-d H:i:s");
    }

    public function toString()
    {
        return "User ID: " . $this->userId .
            " | Name: " . $this->FirstName . " " . $this->LastName .
            " | Email: " . $this->email .
            " | Contact No: " . $this->ContactNo .
            " | Address: " . $this->Address .
            " | Postal Code: " . $this->postalCode .
            " | Province: " . $this->Province .
            " | Location: " . $this->Location .
            " | Profile Image: " . $this->profImage .
            " | Description: " . $this->description .
            " | URL: " . $this->url .
            " | Date Added: " . $this->DateAdded . "<BR>";
    }
}
