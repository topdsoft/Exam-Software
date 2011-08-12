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
		//add a single attempt for one student or for a group
		if (!empty($this->data)) {
			if ($this->data['Attempt']['user_id']==0 && $this->data['Attempt']['group_id']==0) {
				//must pick either single student or group
				$this->Session->setFlash(__('You must select either a single student or a group. Please, try again.', true));
			} else if ($this->data['Attempt']['user_id']!=0 && $this->data['Attempt']['group_id']!=0) {
				//must pick either single student or group
				$this->Session->setFlash(__('You must select either a single student or a group. Please, try again.', true));
			} else {
				//ok, at least one is selected
				if ($this->data['Attempt']['user_id']!=0) {
					//single student selected
					$this->Attempt->create();
					if ($this->Attempt->save($this->data)) {
						$this->Session->setFlash(__('The attempt has been saved', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The attempt could not be saved. Please, try again.', true));
					}
				} else {
					//group selected add each student in group
					$users = CLassRegistry::init('group')->find('first',array('conditions'=>'Group.id='.$this->data['Attempt']['group_id']));
					$outputU='';
					foreach($users['User'] as $user) {
						//loop for each user
						$this->Attempt->create();
						$this->data['Attempt']['user_id']=$user['id'];
						if ($this->Attempt->save($this->data)) $outputU.=$user['username'].',';
					}//end foreach
					$this->Session->setFlash(__('Attempt set up for user(s) '.$outputU, true));
					$this->redirect(array('action' => 'index'));
				}//endif
			}//end if 
		}
		$users = $this->Attempt->User->find('list',array('conditions'=>'role = 1','order'=>'lName'));
		$users[0]='';
		$this->data['Attempt']['user_id']=0;
		$exams = $this->Attempt->Exam->find('list');
		$groups = CLassRegistry::init('group')->find('list');
		$groups[0]='';
		$this->data['Attempt']['group_id']=0;
		$this->set(compact('users', 'exams','groups'));
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