<?php
class ChoicesController extends AppController {

	var $name = 'Choices';

	function index() {
		$this->Choice->recursive = 0;
		$this->set('choices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid choice', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('choice', $this->Choice->read(null, $id));
	}

	function add($id = null) {
		if ($this->data) $id=$this->data['Choice']['question_id'];
		if (!$id) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('controller' => 'exams', 'action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Choice->create();
			if ($this->Choice->save($this->data)) {
				$this->Session->setFlash(__('The choice has been saved', true));
				$this->redirect(array('controller' => 'questions', 'action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The choice could not be saved. Please, try again.', true));
			}
		}
		$this->set('question_id',$id);
		$questions = $this->Choice->Question->find('list');
		$this->set(compact('questions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid choice', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Choice->save($this->data)) {
				$this->Session->setFlash(__('The choice has been saved', true));
				$this->redirect(array('controller' => 'questions', 'action' => 'edit',$this->data['Choice']['question_id']));
			} else {
				$this->Session->setFlash(__('The choice could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Choice->read(null, $id);
		}
		$questions = $this->Choice->Question->find('list');
		$this->set(compact('questions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for choice', true));
			$this->redirect(array('action'=>'index'));
		}
		$question_id=$this->Choice->find($id);
		$question_id=$question_id['Question']['id'];
		if ($this->Choice->delete($id)) {
			$this->Session->setFlash(__('Choice deleted', true));
			$this->redirect(array('controller' => 'questions', 'action' => 'edit',$question_id));
		}
		$this->Session->setFlash(__('Choice was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>