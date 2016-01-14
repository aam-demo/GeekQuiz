<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriviaAnswer extends Model
{
    /*  sessionid VARCHAR(128) NOT NULL ,
	question_id INT NOT NULL ,
	correctly tinyint(1) NOT NULL
     */
    protected $table = 'TriviaAnswer';
    public $timestamps = false;
    
}
