<?php
/* Exams Test cases generated on: 2011-06-03 12:48:26 : 1307123306*/
App::import('Controller', 'Exams');

class TestExamsController extends ExamsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ExamsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.exam', 'app.attempt', 'app.user', 'app.answer', 'app.question', 'app.choice', 'app.image');

	function startTest() {
		$this->Exams =& new TestExamsController();
		$this->Exams->constructClasses();
	}

	function endTest() {
		unset($this->Exams);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>