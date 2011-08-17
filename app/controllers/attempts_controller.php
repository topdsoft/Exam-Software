<?php
class AttemptsController extends AppController {

	var $name = 'Attempts';

	function index() {
		if ($this->Auth->user('role')!=2) $this->redirect(array('action' => 'studentindex'));
		$this->Attempt->recursive = 0;
		$this->set('attempts', $this->paginate());
	}

	function studentindex() {
		//shows student's prior attempts and options to take new test
		if ($this->Auth->user('role')==2) $this->redirect(array('action' => 'index'));
		$this->paginate=array('conditions' => 'User.id='.$this->Auth->User('id'));
		$this->set('attempts', $this->paginate());
	}


	function studenttake($id = null) {
		//$id is attempt id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attempt', true));
			$this->redirect(array('action' => 'studentindex'));
		}
		if ($id) {
			//validate id
			$q=$this->Attempt->query("select * from attempts where date is null and user_id={$this->Auth->user('id')} and id=$id limit 1");
			if (!$q) $this->redirect(array('action' => 'studentindex'));
		} else {
			//get id from form data
			$id=$this->data['Attempt']['attempt_id'];
			//save answer
			$this->Attempt->Answer->create();
			$this->Attempt->Answer->save($this->data['Attempt']);
			unset($this->data['Attempt']);
		}
		//get all questions allready answered
		$q=$this->Attempt->query("select question_id from answers where attempt_id=$id");
		$questionsFinished=array();
		foreach($q as $q2) $questionsFinished[]=$q2['answers']['question_id'];
//debug($q);exit;
		//get exam id
		$exam_id=$this->Attempt->field('exam_id',array('Attempt.id='.$id));
		//get next question
		$question=CLassRegistry::init('question')->find('first',array('conditions'=>array('exam_id='.$exam_id, 'NOT'=> array('Question.id'=>$questionsFinished)),'order'=>'ord'));
		if(empty($question)) {
			//no more questions
			$this->Session->setFlash(__('Test Complete', true));
			//set date of test taken
			$this->Attempt->set('id',$id);
			$this->Attempt->set('date',date('Y-m-d H:i:s'));
			$this->Attempt->save();
			$this->redirect(array('action' => 'studentindex'));
		}//endif
		$this->set('question',$question);
		//get all attempt info
		$this->Attempt->recursive=2;
		$att=$this->Attempt->read(NULL,$id);
		$this->set('attempt',$att);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attempt', true));
			$this->redirect(array('action' => 'index'));
		}
		//get list of correct answers for multiple chouce questions
		$q=$this->Attempt->query("select questions.id,choices.text from choices,questions,attempts where 
			choices.id=questions.answer and questions.exam_id=attempts.exam_id and attempts.id=$id");
		$answers=array();
		foreach($q as $e) $answers[$e['questions']['id']]=$e['choices']['text'];
		$this->set('answers',$answers);
//debug($answers);exit;
		$this->Attempt->recursive=2;
		$this->set('attempt', $this->Attempt->read(null, $id));
		$this->set('role',$this->Auth->user('role'));
	}

	function grade($id=null) {
		//grade an attempt
		if ($this->Auth->user('role')!=2) $this->redirect(array('action' => 'studentindex'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attempt', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//returning
			foreach($this->data['answer'] as $answer_id=>$answer) {
				//loop for all returning answers
				$this->Attempt->query("update answers set score={$answer['score']}, comments='{$answer['comments']}' where answers.id=$answer_id limit 1");
//				echo $answer_id;debug($answer);
			}//end foreach
			//set attempt graded date
			$this->Attempt->query("update attempts set graded=now() where attempts.id={$this->data['Attempt']['id']} limit 1");
			$this->Session->setFlash(__('Attempt Graded ', true));
			$this->redirect(array('action' => 'index'));
//debug($this->data);exit;
		}//endif
		$this->Attempt->recursive=2;
		$attempt=$this->Attempt->read(null,$id);
		foreach($attempt['Answer'] as $answer) {
			//loop for all answers
			if($answer['Question']['type']) {
				//score multiple choice answer
				if ($answer['choice_id']==$answer['Question']['answer']) $answer['score']=$answer['Question']['value'];
				else $answer['score']=0;
				//save score
				$this->Attempt->query("update answers set score={$answer['score']} where id={$answer['id']} limit 1");
			}//endif
		}//end foreach
		$this->set('attempt',$attempt);
	}

	function add() {
		//add a single attempt for one student or for a group
		if ($this->Auth->user('role')!=2) $this->redirect(array('action' => 'studentindex'));
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
		if ($this->Auth->user('role')!=2) $this->redirect(array('action' => 'studentindex'));
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
		if ($this->Auth->user('role')!=2) $this->redirect(array('action' => 'studentindex'));
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