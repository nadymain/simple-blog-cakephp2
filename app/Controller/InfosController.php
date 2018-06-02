<?php
App::uses('AppController', 'Controller');
/**
 * Infos Controller
 *
 * @property Info $Info
 * @property PaginatorComponent $Paginator
 */
class InfosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * paginate
 *
 * @var array
 */
	public $paginate = array(
		'order' => array(
            'Info.created' => 'Desc'
        ),
		'limit' => 2,
		'paramType' => 'querystring',
	);

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug = null) {
        $info = $this->Info->find('first', array(
            'conditions' => array (
                'Info.slug' => $slug,
                'Info.status' => 'published'
            )
        ));
        if(!$info) {
            throw new NotFoundException();
        }
        $this->set('info', $info);
	}


/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Info->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('infos', $this->Paginator->paginate('Info'));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Info->create();
			if ($this->Info->save($this->request->data)) {
				$this->Flash->success(__('The info has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Info->id));
			} else {
				$this->Flash->error(__('The info could not be saved. Please, try again.'));
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
		if (!$this->Info->exists($id)) {
			throw new NotFoundException(__('Invalid info'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Info->save($this->request->data)) {
				$this->Flash->success(__('The info has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->Info->id));
			} else {
				$this->Flash->error(__('The info could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Info.' . $this->Info->primaryKey => $id));
			$this->request->data = $this->Info->find('first', $options);
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
		$this->Info->id = $id;
		if (!$this->Info->exists()) {
			throw new NotFoundException(__('Invalid info'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Info->delete()) {
			$this->Flash->success(__('The info has been deleted.'));
		} else {
			$this->Flash->error(__('The info could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * dashboard_status method
 */
	public function dashboard_status($field = null, $id = null) {	
		$data = array('status' => $field, 'id' => $id);
		if ($this->Info->save($data)) {
			$this->Flash->success(__('The info has been update.'));
		} else {
			$this->Flash->error(__('The info could update.'));
		}
		return $this->redirect($this->referer());
	}
}
