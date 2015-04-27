<?php
	include_once 'utils/Controller.php';
	include_once 'model/Question.php';
	include_once 'model/Answer.php';
	include_once 'model/Comment.php';
	include_once 'utils/Parsedown.php';

	class ViewQuestionController extends Controller{

		public function __construct(){
			/*
				Set title
			*/
			$this->setTitle('Question');
			/*
				Set View
			*/
			$this->setView('question.php');


			/*
				Add css files
			*/
			$this->addCss('question.css');
			$this->addCss('parsedown.css');
			$this->addCss('answer.css');
			$this->addCss('comment.css');
		}

		public function handle(){

			$question = new Question();
			$question->setVotes(20);
			$question->setDatePosted('27/4/2015');
			$question->setTitle("In the spirit of open source software development, jQuery always encourages community code contribution.");
			$parse = new Parsedown();
			$question->setHtml( $parse->text('[jQuery](http://jquery.com/) - New Wave JavaScript
==================================================
Contribution Guides
--------------------------------------

In the spirit of open source software development, jQuery always encourages community code contribution. To help you get started and before you jump into writing code, be sure to read these important contribution guidelines thoroughly:

1. [Getting Involved](http://docs.jquery.com/Getting_Involved)
2. [Core Style Guide](http://docs.jquery.com/JQuery_Core_Style_Guidelines)
3. [Tips For Bug Patching](http://docs.jquery.com/Tips_for_jQuery_Bug_Patching)


What you need to build your own jQuery
--------------------------------------

In order to build jQuery, you need to have Node.js/npm latest and git 1.7 or later.
(Earlier versions might work OK, but are not tested.)

For Windows you have to download and install [git](http://git-scm.com/downloads) and [Node.js](http://nodejs.org/download/).

Mac OS users should install [Homebrew](http://mxcl.github.com/homebrew/). Once Homebrew is installed, run `brew install git` to install git,
and `brew install node` to install Node.js.

Linux/BSD users should use their appropriate package managers to install git and Node.js, or build from source
if you swing that way. Easy-peasy.


How to build your own jQuery
----------------------------

Clone a copy of the main jQuery git repo by running:

```bash
git clone git://github.com/jquery/jquery.git
```

Enter the jquery directory and run the build script:
```bash
cd jquery && npm run-script build
```
The built version of jQuery will be put in the `dist/` subdirectory, along with the minified copy and associated map file.

If you want create custom build or help with jQuery development, it would be better to install <a href="https://github.com/gruntjs/grunt-cli">grunt command line interface</a> as a global package:

'));

			$user = new SimpleUser();
			$user->setUsername("Useropoulos");

			$question->setUser($user);

			$comment = new Comment();
			$comment->setText("Similar problem: stackoverflow.com/questions/29737908/…");
			$comment->setVotes(0);
			$comment->setDate("27/4/2015");
			$comment->setUser($user);

			$question->addComment($comment);

			$c2 = new Comment();
			$c2->setText("Can you try and let me know");
			$c2->setVotes(1);
			$c2->setDate("27/4/2015");
			$c2->setUser($user);

			$question->addComment($c2);

			$c3 = new Comment();
			$c3->setText("	
I just checked the code in iOS 8.3 Safari (iPhone 6+); no issues - changed the orientation 50 times. What device are you using? As @Duraiamuthan.H suggested, add the maximum and minimum scale (I would say to 0.7 not, so the scale doesn't change from 0.7). My guess for this problem is that, the iOS rendering tries to get 60% of the current scale every time. Sounds like a very weird bug to me. Try to close Safari and reopen it. If that doesn't fix the issue, report a bug to Apple (or you have a broken iOS install)");
			$c3->setVotes(3);
			$c3->setDate("27/4/2015");
			$c3->setUser($user);

			$question->addComment($c3);

			$c4 = new Comment();
			$c4->setText("@Piwwoli - It seems like Bug to me as well.Because the issue happens in particular version of yours.I couldn't reproduce it and you are also not able to reproduce this issue in your 8.3 so we can assume apple has released a patch for this.");
			$c4->setVotes(2);
			$c4->setDate("27/4/2015");
			$c4->setUser($user);

			$question->addComment($c4);	


			$answer = new Answer();
			$answer->setUser($user);
			$answer->setText($parse->text("## Welcome to Rails

Rails is a web-application framework that includes everything needed to
create database-backed web applications according to the
[Model-View-Controller (MVC)](http://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
pattern.
```
	public static void main(String args[]){

		System.out.println(\"Random Code \");
	}
```
Understanding the MVC pattern is key to understanding Rails. MVC divides your
application into three layers, each with a specific responsibility.

The _Model layer_ represents your domain model (such as Account, Product,
Person, Post, etc.) and encapsulates the business logic that is specific to
your application. In Rails, database-backed model classes are derived from
`ActiveRecord::Base`. Active Record allows you to present the data from
database rows as objects and embellish these data objects with business logic
methods. Although most Rails models are backed by a database, models can also"));
			$answer->addComment($comment);
			$answer->addComment($c4);	
			$answer->setDate("27/4/2015");
			$answer->setVotes(2);

			$question->addAnswer($answer);


			$args['question'] = $question;
			/*
				Show View
			*/
			$this->showView($args);
		}

	}