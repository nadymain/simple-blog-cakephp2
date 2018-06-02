<?php
App::uses('AppController', 'Controller');
/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 */
class SettingsController extends AppController {

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->Setting->find('all'));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Setting->create();
			if ($this->Setting->save($this->request->data)) {
				Cache::delete('cache_settings', 'long');
				$this->Flash->success(__('The setting has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Setting->id));
			} else {
				$this->Flash->error(__('The setting could not be saved. Please, try again.'));
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
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Setting->save($this->request->data)) {
				Cache::delete('cache_settings', 'long');
				$this->Flash->success(__('The setting has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->Setting->id));
			} else {
				$this->Flash->error(__('The setting could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
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
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Setting->delete()) {
			Cache::delete('cache_settings', 'long');
			$this->Flash->success(__('The setting has been deleted.'));
		} else {
			$this->Flash->error(__('The setting could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
