<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * login
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Flash->success(__('You have been successfully logged in.'));
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}

		if ($this->Auth->loggedIn()) {
			$this->Flash->success('You are logged in!');
			return $this->redirect($this->Auth->redirectUrl());
		}
	}

/**
 * logout
 */
	public function logout() {
		$this->Flash->success('You have been logged out successfully.');
		return $this->redirect($this->Auth->logout());
	}

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->User->find('all'));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->User->id));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				// update auth
				$data = $this->User->read(null, $this->Auth->user('id'))['User'];
				unset($data['password']);
				$this->Auth->login($data);

				$this->Flash->success(__('The user has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->User->id));
			} else {
				$this->Flash->error(__('The user could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($id == '1') {
			$this->Flash->error(__('The category with id = 1 could not be deleted.'));
			return $this->redirect(array('action' => 'index'));
		}
		
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
