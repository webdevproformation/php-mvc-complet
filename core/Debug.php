<?php 
declare(strict_types=1);

namespace app\core ;

class Debug{


  public static function dump($var){

    echo "<pre onclick='show()'>";
    var_dump($var);
    echo "</pre>";
    echo "<pre class='hide-block' id='debug_backtrace'> ";
    //var_dump(debug_backtrace());
    var_dump(debug_print_backtrace());
    echo "</pre>";
    echo "<style>
      .hide-block{
        display: none;
      }
    </style>";
    echo "<script>
    function show(){
      document.querySelector('#debug_backtrace').classList.toggle('hide-block')
    }
    </script>";
    die();
    
  }

}
