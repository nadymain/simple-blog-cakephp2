<?php
App::uses('AppController', 'Controller');
/**
 * Sliders Controller
 *
 * @property Slider $Slider
 * @property PaginatorComponent $Paginator
 */
class SlidersController extends AppController {

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Slider->recursive = 0;
		$this->set('sliders', $this->Slider->find('all',
			array(
				'order' => 'Slider.created Desc'
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
			$this->Slider->create();
			if ($this->Slider->save($this->request->data)) {
				$this->Flash->success(__('The slider has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Slider->id));
			} else {
				$this->Flash->error(__('The slider could not be saved. Please, try again.'));
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
		if (!$this->Slider->exists($id)) {
			throw new NotFoundException(__('Invalid slider'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Slider->save($this->request->data)) {
				$this->Flash->success(__('The slider has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->Slider->id));
			} else {
				$this->Flash->error(__('The slider could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Slider.' . $this->Slider->primaryKey => $id));
			$this->request->data = $this->Slider->find('first', $options);
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
		$this->Slider->id = $id;
		if (!$this->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Slider->delete()) {
			$this->Flash->success(__('The slider has been deleted.'));
		} else {
			$this->Flash->error(__('The slider could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
