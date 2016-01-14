<?php

namespace App;

// domain (service) layer 

class DL {

    public static function nextQuestion() {
        // get random, unique-for-user question 
        $sessionID = self::userID();

        $results = Question::
                orderByRaw("RAND()")
                ->first();

        // TODO: ensure uniqueness, raw NOT IN query
        /* $results  = Question::whereNotIn('id', function($q){
          $q->select('question_id')
          ->from('TriviaAnswer')
          ->where('sessionid' , $sessionID);
          })
          ->orderByRaw("RAND()") /* better to skip X and take 1 * /
          ->first();
         * DB::table('users')
          ->whereNotIn('id', [1, 2, 3])
          ->get();
         * TODO get this working
         */

        if (empty($results)) {
            //TODO handle no more new questions 
            return;
        }

        /* ember properties:
          {{bindAttr class=":back question.answered:flip answer" }}>
          <p class="lead">
          {{answer}}
          ...
          <div {{bindAttr class=":front question.answered:flip" }}>
          <p class="lead">
          {{question.title}}
          ...
          {{#each option in question.options}}
          <button class="btn btn-info btn-lg option" {{action "sendAnswer" question option}}>{{option.title}}</button>
          {{/each}}
         */

        $options = AnswerOption::where('question_id', $results->id)
                ->get();

        $o = [];
        foreach ($options as $value) {
            $o[] = [
                'id' => $value->id,
                'title' => $value->answer_text
            ];
        }

        $result = [
            'id' => $results->id,
            'title' => $results->question_text,
            'options' => $o
        ];

        return $result; // controller will jsonize
    }

    // returns 1 or 0 = is answer correct 
    public static function storeAnswer($questionID, $answerID) {
        $sessionID = self::userID();

        // question id not needed
        $answer = AnswerOption::where('id', $answerID)
                ->first();

        //TODO: fail fast ; exception if no answer 

        $ta = new TriviaAnswer;
        $ta->sessionid = $sessionID;
        $ta->question_id = $questionID;
        $ta->correctly = (int) $answer->is_true;

        $ta->save(); //TODO try...catch or check return code
        //TODO: don't store duplicates 

        return (int) $answer->is_true;
    }

    public static function percentCorrect() {

        $sessionID = self::userID(); // safe string (internal)
        
// raw MySQL ; less than ideal 
        $sql = 'select sum(correctly)/count(*) as result from triviaanswer where sessionid = \''
                . $sessionID . '\' ;';

        $percent = \DB::select($sql);

        /* laravel param binding  doesnt work  'select sum(correctly)/count(*) as result from triviaanswer where sessionid = \'?\'' ,
          [$sessionID] ); */

        if (empty($percent)) {
            return 0; // 
        }

        $result = $percent[0];
        return (int) (100.0 * (float) $result->result );

        //TODO: clear old entries somewhere
    }

    static function userID() {
        //sufficient for demo purposes:
        $ip = $_SERVER['REMOTE_ADDR'];
        $ua = $_SERVER['HTTP_USER_AGENT'];
        return md5($ip . $ua);
    }

}
