<?php
class UsersController extends AppController {

	var $name = 'Users';

	function beforeFilter() {
		parent::beforeFilter();
		$q=$this->User->query('select * from users');
		//check if this is the first user added, if so allow add without auth
		if(!$q) $this->Auth->allow('add');
//		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
	} 

	function index() {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
		if (!empty($this->data)) {
			$q=$this->User->query('select * from users');
			//check if this is the first user added, if so make role=2
			if(!$q) $this->data['User']['role']=2;
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
//		$groups=$this->User->Group->find('list');
//		array_unshift($groups,NULL);
//		$this->set(compact('groups'));
	}

	function edit($id = null) {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				//if no user logged in then log in new user (probably the first user created)
				if (!$this->Auth->user('id')) $this->Auth->login($this->data);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			$this->data['User']['password']=NULL;
		}
//		$groups=$this->User->Group->find('list');
//		array_unshift($groups,NULL);
//		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function login(){
	$q=$this->User->query('select * from users');
	//check if this is the first user added, if so redirect to add user
	if(!$q) $this->redirect(array('action' => 'add'));
	}
	
	function logout(){
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}

}
?>