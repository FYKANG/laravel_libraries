<?php namespace App\Exceptions;

class upload_imgException extends \Exception
{
    public function __construct($msg = ''){
        parent::__construct($msg);
    }
}
