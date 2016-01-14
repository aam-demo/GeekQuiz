<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
// didnt work ;;use Illuminate\Http\Request;

class TriviaController extends Controller
{
     
    public function getTrivia( )
    {
        $nextquestion = \App\DL::nextQuestion(  );
        
        return response()->json( (array) $nextquestion); 
        
    }
    
    public function postTrivia( /*Request $request ;; didnt work*/ )
    {
        // ember POSTs:  'questionId': question.id, 'optionId': option.id 
        
        $questionId = $_POST[ 'questionId'];
        $answerId = $_POST[ 'optionId'];
        
        $answer = \App\DL::storeAnswer($questionId, $answerId);
        $percent = \App\DL::percentCorrect( ) ; 
        
        return response()->json( [ 
            'answer' => $answer ,
            'percent' => $percent
        ]) ;
    }
}
