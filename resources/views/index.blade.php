
@extends('layouts.main')

@section('content')

<div id="bodyContainer"></div>

<script type="text/x-handlebars" id="index">
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="flip-container text-center col-md-12">
                    <div <?= "{{" ?>bindAttr class=":back question.answered:flip answer" }}>
                        <p class="lead">
    <?= "{{{" ?>answer}}}
                        </p>
                
                        <p>
                            <button class="btn btn-info btn-lg next option" <?= "{{" ?>action "nextQuestion" option}}>Next Question</button>
                        </p>
                    </div>
                    <div <?= "{{" ?>bindAttr class=":front question.answered:flip" }}>
                        <p class="lead">
    <?= "{{" ?>question.title}}
                        </p>
                        <div class="row text-center">
    <?= "{{" ?>#each option in question.options}}
                                <button class="btn btn-info btn-lg option" <?= "{{" ?>action "sendAnswer" question option}}><?= "{{" ?>option.title}}</button>
    <?= "{{" ?>/each}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</script>

<script>
    var App = Ember.Application.create({rootElement: '#bodyContainer'});

    App.Question = Ember.Object.extend({title: "loading question...", options: [], answered: false});

    App.IndexController = Ember.ObjectController.extend({
        question: null,
        answer: null,
        init: function () {
            this._super();
            this.nextQuestion();
        },
        nextQuestion: function () {

            var controller = this;
            var question = App.Question.create();
            this.set('question', question);

            jQuery.getJSON("api/trivia", function (response) {
                question.setProperties(response);

            }).fail(function () {
                question.set('title', "Oops... something went wrong")
            });
        },
        sendAnswer: function (question, option) {
            var controller = this;

            // prevent multiple posts for the same question
            jQuery('.front button').attr('disabled', 'disabled');

            jQuery.post('api/trivia', {'questionId': question.id, 'optionId': option.id}, function (response) {
                   var settext = response.answer == '1' ? 'correct' : 'incorrect!';
                   settext += '<div>'+ response.percent + '% answered correctly</div>';
                controller.set('answer', settext);
                controller.set('question.answered', true);
            });
        }
    });
</script>

@endsection
