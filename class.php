<?php
//     class Car{
//         // Properties
//         public $model;
//         public $color;

//         // Method
//        public function set_model($model){
//             $this->model = $model;
//         }

//        public function get_model(){
//             return $this->model;
//         }

//         private function set_color($color){
//             $this->color = $color;
//         }
//         private function get_color(){
//             return $this->color;
//         }
//     }

//  $car1 = new Car();
//  $car2 = new Car();
//  $car1->set_model("Toyota");
//  $car1->set_color2("white");
//  $car2->set_model("Ferari");
//  $car2->set_color("red");

//  echo $car1->get_model();
//  echo $car1->get_color();
// class book1 {
//     public $name;
//     public $price;

//     public function setBook($name, $price) {
//         $this->name = $name;
//         $this->price = $price;
//     }
//     public function getBook() {
//         return array($this->name, $this->price);
//     }
// }

// class book2 extends book1 {

// }

class User
{
    // Properties
    public $idnumber;
    public $name;
    public $lastname;
    public $age;
    public $email;

    // Method
    public function __construct($idnumber, $name, $lastname, $age, $email)
    {
        $this->idnumber = $idnumber;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->email = $email;
    }

    public function get_User()
    {
        return array($this->idnumber, $this->name, $this->lastname, $this->age, $this->email);
    }
}

$user1 = new User(15, "Thanaphon", "ThongDee", 27, "thanaphon10500@hotamil.com");
print_r($user1->get_User());

class MySQL
{

}
