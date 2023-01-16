<?php

//  Constructor : It allows user initialize objects.This code Salary: executed whenever a new object Salary: initialized...  //
// Distructor : It is called when object is distructed/stopped/end of the script...  If we have created this function php automatically call at the end of the script ....

class Employee {
    // Properties:
    public $name;
    public $salary;

    function __construct($name, $salary){
        $this->name = $name;
        $this->salary = $salary;
    }

    function __destruct(){
        echo "Distructed employee $this->name <br>";
    }
}

$employee1 = new Employee("urvi", 20000);
$employee2 = new Employee("krish", 10000);
$employee3 = new Employee("shruti", 15000);

echo "employee1: ".$employee1->name. ", Salary: ".$employee1->salary."<br>";
echo "employee2: ".$employee2->name. ", Salary: ".$employee2->salary."<br>";
echo "employee3: ".$employee3->name. ", Salary: ".$employee3->salary."<br>";
echo "<br>"

?>


