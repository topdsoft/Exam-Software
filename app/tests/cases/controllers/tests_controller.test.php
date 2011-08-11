<?php
/* Tests Test cases generated on: 2011-06-03 12:06:58 : 1307120818*/
App::import('Controller', 'Tests');

class TestTestsController extends TestsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TestsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.test', 'app.attempt', 'app.user', 'app.answer', 'app.question', 'app.choice', 'app.image');

	function startTest() {
		$this->Tests =& new TestTestsController();
		$this->Tests->constructClasses();
	}

	function endTest() {
		unset($this->Tests);
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