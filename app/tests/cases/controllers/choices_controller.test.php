<?php
/* Choices Test cases generated on: 2011-06-03 12:06:24 : 1307120784*/
App::import('Controller', 'Choices');

class TestChoicesController extends ChoicesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChoicesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.choice', 'app.question', 'app.test', 'app.attempt', 'app.user', 'app.answer', 'app.image');

	function startTest() {
		$this->Choices =& new TestChoicesController();
		$this->Choices->constructClasses();
	}

	function endTest() {
		unset($this->Choices);
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