<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 */
class ImagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator',
		'Search.Prg',
	);

/**
 * paginate
 *
 * @var array
 */
	public $paginate = array(
		'order' => array(
            'Image.created' => 'Desc'
        ),
		'limit' => 2,
		'paramType' => 'querystring',
	);

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Image->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = array(
			$this->Image->parseCriteria($this->Prg->parsedParams())
		);
		$this->set('images', $this->Paginator->paginate('Image'));

		// total
		$total = $this->Image->find('count');
		$this->set('total', $total);
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
				$this->Flash->success(__('The image has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The image could not be saved. Please, try again.'));
			}
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
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Image->delete()) {
			$this->Flash->success(__('The image has been deleted.'));
		} else {
			$this->Flash->error(__('The image could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * dashboard_iframeindex method
 *
 * @return void
 */
	public function dashboard_iframeindex() {
		$this->Image->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = array(
			$this->Image->parseCriteria($this->Prg->parsedParams())
		);
		$this->set('images', $this->Paginator->paginate('Image'));

		// total
		$total = $this->Image->find('count');
		$this->set('total', $total);
	}

/**
 * dashboard_iframeadd method
 *
 * @return void
 */
	public function dashboard_iframeadd() {
		if ($this->request->is('post')) {
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
				$this->Flash->success(__('The image has been saved.'));
				if ($this->request->query('type') === 'modal') {
					return $this->redirect(
						array(
							'controller' => 'images',
							'action' => 'iframeindex', 
							'?' => 'type=modal'
						)
					);
				} else {
					return $this->redirect(
						array(
							'controller' => 'images',
							'action' => 'iframeindex', 
							'?' => 'type=tinymce'
						)
					);
				}
			} else {
				$this->Flash->error(__('The image could not be saved. Please, try again.'));
			}
		}
	}

/**
 * dashboard_iframedelete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_iframedelete($id = null) {
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}

		$this->request->allowMethod('post', 'delete');

		if ($this->Image->delete()) {
			$this->Flash->success(__('The image has been deleted.'));
		} else {
			$this->Flash->error(__('The image could not be deleted. Please, try again.'));
		}

		return $this->redirect($this->referer());
	}
}
