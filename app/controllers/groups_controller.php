<?php
class GroupsController extends AppController {

	var $name = 'Groups';

	function beforeFilter() {
		parent::beforeFilter();
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'attempts','action' => 'index'));
	} 
	
	function index() {
		$this->Group->recursive = 1;
		$this->set('groups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Group->create();
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
	}

	function members($id = null) {
		if (!empty($this->data)) {
			//adding a member
			$this->redirect(array('action' => 'addMember',$this->data['Group']['group_id'],$this->data['Group']['user_id']));
			debug($this->data);exit;
		}//endif
		if (!$id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
		//get list of users allready in group to exclude
		$q=$this->Group->query("select user_id from groups_users where group_id=$id");
		$exclude=array();
		foreach($q as $q2) $exclude[]=$q2['groups_users']['user_id'];//debug($exclude); exit;
		$users=$this->Group->User->find('list',array('order'=>'lName','conditions'=>array('User.role=1','User.id not' => $exclude)));
		$this->set(compact('users'));
	}

	function addMember($group_id = null,$user_id = null) {
		if (!$group_id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$q=$this->Group->query("select * from groups_users where group_id=$group_id and user_id=$user_id limit 1");
		if ($q) {
			$this->Session->setFlash(__('User already in group', true));
			$this->redirect(array('action' => 'members', $group_id));
		}
		$q=$this->Group->query("insert into groups_users (user_id,group_id) values ($user_id,$group_id)");
		$this->redirect(array('action' => 'members', $group_id));
	}

	function removeMember($group_id = null,$user_id = null) {
		if (!$group_id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$q=$this->Group->query("delete from groups_users where user_id=$user_id and group_id=$group_id limit 1");
		$this->redirect(array('action' => 'members', $group_id));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Group->delete($id)) {
			$this->Session->setFlash(__('Group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>