<?php
class ExamsController extends AppController {

	var $name = 'Exams';

	function beforeFilter() {
		parent::beforeFilter();
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
	} 
	
	function index() {
		$this->Exam->recursive = 0;
		$this->set('exams', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid exam', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('exam', $this->Exam->read(null, $id));
		$f=array('Question.id','Question.ord');
		$this->set('questions',$this->Exam->Question->find('all',array('order'=>'ord','recursive'=>0,'conditions'=>'exam_id='.$id)));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Exam->create();
			if ($this->Exam->save($this->data)) {
				$this->Session->setFlash(__('The exam has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exam could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid exam', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Exam->save($this->data)) {
				$this->Session->setFlash(__('The exam has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exam could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Exam->recursive = 2;
			$this->data = $this->Exam->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for exam', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Exam->delete($id)) {
			$this->Session->setFlash(__('Exam deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Exam was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>