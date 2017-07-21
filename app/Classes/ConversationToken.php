<?php

namespace App\Classes;  

class ConversationToken

{

    /**
     * @var
     */
    public $prefix;

    /**
     * @var
     */
    public $length;

    /**
     * @param string $prefix
     * @param integer $length
     */

    public function __construct($length, $prefix = '')
    {   
        $this->prefix = $prefix;

        $this->token = $this->prefix . str_random($length);

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->token;
    }

}

?>