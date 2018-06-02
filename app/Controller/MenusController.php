<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 */
class MenusController extends AppController {

/**
 * navmenu method
 *
 */
	public function mainmenu() {
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}

		$mainmenu = $this->Menu;
		return Cache::remember('mainmenu', function() use ($mainmenu){
			return $mainmenu->find('threaded', array(
				'order' => 'Menu.lft ASC',
			));
		}, 'long');
	}

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->Menu->find('all', 
			array(
				'order' => 'Menu.lft ASC'
			)
		));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				Cache::delete('mainmenu', 'long');
				$this->Flash->success(__('The menu has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Menu->id));
			} else {
				$this->Flash->error(__('The menu could not be saved. Please, try again.'));
			}
		}
		$conditions = array('parent_id' => NULL);
		$parents = $this->Menu->generateTreeList($conditions, null, null, '— ');
		$this->set(compact('parents'));
	}

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menu->save($this->request->data)) {
				Cache::delete('mainmenu', 'long');
				$this->Flash->success(__('The menu has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->Menu->id));
			} else {
				$this->Flash->error(__('The menu could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$conditions = array('parent_id' => NULL, 'id !=' => $id);
		$parents = $this->Menu->generateTreeList($conditions, null, null, '— ');
		$this->set(compact('parents'));
	}

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Menu->delete()) {
			Cache::delete('mainmenu', 'long');
			$this->Flash->success(__('The menu has been deleted.'));
		} else {
			$this->Flash->error(__('The menu could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * movedown method
 *
 * @return void
 */
	public function dashboard_movedown($id = null, $delta = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException();
		}

		if ($delta > 0) {
			Cache::delete('navmenu', 'long');
			$this->Menu->moveDown($this->Menu->id, abs($delta));
			$this->Flash->success('The menu has been moved down.');
		} else {
			$this->Flash->error(
				'Please provide the number of positions the field should be' .
				'moved down.'
			);
		}

		return $this->redirect(array('action' => 'index'));
	}

/**
* moveup method
*
* @return void
*/
	public function dashboard_moveup($id = null, $delta = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException();
		}

		if ($delta > 0) {
			Cache::delete('navmenu', 'long');
			$this->Menu->moveUp($this->Menu->id, abs($delta));
			$this->Flash->success('The menu has been moved up.');
		} else {
			$this->Flash->error(
				'Please provide the number of positions the field should be' .
				'moved up.'
			);
		}
		
		return $this->redirect(array('action' => 'index'));
	}
}
