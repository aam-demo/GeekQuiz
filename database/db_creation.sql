CREATE TABLE Question (
	id INT  NOT NULL PRIMARY KEY,
	question_text VARCHAR(250) NOT NULL
);

CREATE TABLE AnswerOption (
	id INT  NOT NULL PRIMARY KEY,
	answer_text VARCHAR(250) NOT NULL,
	is_true tinyint(1) NOT NULL ,
	question_id INT NOT NULL
);

CREATE TABLE TriviaAnswer (
	sessionid VARCHAR(128) NOT NULL ,
	question_id INT NOT NULL ,
	correctly tinyint(1) NOT NULL
);

-- not shown: foreign keys
