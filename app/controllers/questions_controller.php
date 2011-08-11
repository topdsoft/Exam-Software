<?php
class QuestionsController extends AppController {

	var $name = 'Questions';

	function beforeFilter() {
		parent::beforeFilter();
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
	} 
	
/*	function index() {
		$this->Question->recursive = 0;
		$this->set('questions', $this->paginate());
	}//*/

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

	function add($eid = null) {
		if ($this->data) $eid=$this->data['Question']['exam_id'];
		if (!$eid) {
			$this->Session->setFlash(__('Invalid exam', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Question->create();
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The question has been saved', true));
				//if mutlepule choice then start sdding choices
				if ($this->data['Question']['type']==1) $this->redirect(array('controller' => 'choices', 'action' => 'add',$this->Question->getInsertID()));
				else $this->redirect(array('controller' => 'exams', 'action' => 'edit',$eid));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.', true));
			}
		}
		$this->set('exam_id',$eid);
		$exams = $this->Question->Exam->find('list');
		$this->set(compact('exams'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The question has been saved', true));
				$this->redirect(array('controller' => 'exams', 'action' => 'edit',$this->data['Question']['exam_id']));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Question->read(null, $id);
		}
		$exams = $this->Question->Exam->find('list');
		$this->set(compact('exams'));
	}
	
	function moveUp($id = null,$ret='view') {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->data = $this->Question->read(null, $id);
		//find a question to switch with
		$oldOrd=$this->data['Question']['ord'];
		//find next highest
		$otherId=$this->Question->field('id',array('exam_id='.$this->data['Question']['exam_id'],'ord<'.$oldOrd),'ord desc');
		$newOrd=$this->Question->field('ord',array('id='.$otherId));
		$this->data['Question']['ord']=$newOrd;
		$this->Question->save($this->data);
		//now change other question
		$this->data = $this->Question->read(null, $otherId);
		$this->data['Question']['ord']=$oldOrd;
		$this->Question->save($this->data);
		$this->redirect(array('controller' => 'exams', 'action' => $ret,$this->data['Question']['exam_id']));
		debug($this->data);debug($newOrd);exit;
	}

	function moveDown($id = null,$ret='view') {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->data = $this->Question->read(null, $id);
		//find a question to switch with
		$oldOrd=$this->data['Question']['ord'];
		//find next lowest
		$otherId=$this->Question->field('id',array('exam_id='.$this->data['Question']['exam_id'],'ord>'.$oldOrd),'ord asc');
		$newOrd=$this->Question->field('ord',array('id='.$otherId));
		$this->data['Question']['ord']=$newOrd;
		$this->Question->save($this->data);
		//now change other question
		$this->data = $this->Question->read(null, $otherId);
		$this->data['Question']['ord']=$oldOrd;
		$this->Question->save($this->data);
		$this->redirect(array('controller' => 'exams', 'action' => $ret,$this->data['Question']['exam_id']));
		debug($this->data);debug($newOrd);exit;
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for question', true));
			$this->redirect(array('action'=>'index'));
		}
		$exam_id=$this->Question->find($id);
		$exam_id=$exam_id['Exam']['id'];
		if ($this->Question->delete($id)) {
			$this->Session->setFlash(__('Question deleted', true));
			$this->redirect(array('controller' => 'exams', 'action' => 'edit',$exam_id));
		}
		$this->Session->setFlash(__('Question was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>