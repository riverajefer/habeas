<?php
namespace App\Helpers;
use Jenssegers\Agent\Agent;


class MyFuncs {

        /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->device = Agent::device();
    }


    public static function full_name($first_name,$last_name) {
        return 'Full name: '. $first_name . ', '. $last_name;   
    }

}