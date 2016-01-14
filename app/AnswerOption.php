<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    /* id INT  NOT NULL PRIMARY KEY,
	answer_text VARCHAR(250) NOT NULL,
	is_true tinyint(1) NOT NULL ,
	question_id INT NOT NULL
     */
    
    protected $table = 'AnswerOption';
    public $timestamps = false;
    
}
