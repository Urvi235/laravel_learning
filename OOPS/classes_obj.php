<?php
                                    //  Classes and Objects     //
//  CLASS : templetes for objects ...   OBJECTS : Instance of a class ...

class Player {
    // Properties :
    public $name;
    public $speed = 5;
    public $running = False;
    
    // Methods : 
    function set_name($name){
        $this->name = $name; 
        return $this->name;  
    }

    function run(){
        $this->running = True;
    }

    function stopRun(){
        $this->running = False;
    }
}

$player1 = new Player();
echo "Player1:-"."<br>";
echo " name :". $player1->set_name("Urvi")."<br>";
$player1->run();
echo " player_Running_Status :".$player1->running."<br>";
echo "<br>";


$player2 = new Player();
echo " Player2:-"."<br>";
$player2->set_name("Shruti");
// get player name without calling funtion ----
echo " name :". $player2->name."<br>";   
echo " speed :".$player2->speed."<br>";           
echo "<br>";


$player3 = new Player();
echo "Player3:-"."<br>";
echo " name :".$player3->set_name("krish")."<br>";
                                 
?>

