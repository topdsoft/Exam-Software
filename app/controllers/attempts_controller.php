<?php
class AttemptsController extends AppController {

	var $name = 'Attempts';

	function index() {
		$this->Attempt->recursive = 0;
		$this->set('attempts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attempt', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attempt', $this->Attempt->read(null, $id));
	}

	function add() {
		//add a single attempt for one student
		if (!empty($this->data)) {
			$this->Attempt->create();
			if ($this->Attempt->save($this->data)) {
				$this->Session->setFlash(__('The attempt has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attempt could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Attempt->User->find('list',array('conditions'=>'role = 1'));
		$exams = $this->Attempt->Exam->find('list');
		$this->set(compact('users', 'exams'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attempt', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attempt->save($this->data)) {
				$this->Session->setFlash(__('The attempt has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attempt could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attempt->read(null, $id);
		}
		$users = $this->Attempt->User->find('list',array('conditions'=>'role = 1'));
		$exams = $this->Attempt->Exam->find('list');
		$this->set(compact('users', 'exams'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attempt', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attempt->delete($id)) {
			$this->Session->setFlash(__('Attempt deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attempt was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>