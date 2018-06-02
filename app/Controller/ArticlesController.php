<?php
App::uses('AppController', 'Controller');
/**
 * Articles Controller
 *
 * @property Article $Article
 * @property PaginatorComponent $Paginator
 */
class ArticlesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator',
		'Search.Prg'
	);

/**
 * paginate
 *
 * @var array
 */
	public $paginate = array(
		'order' => array(
            'Article.created' => 'Desc',
            'Article.id' => 'Desc'
        ),
		'limit' => 2,
		'paramType' => 'querystring',
	);


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Article->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->Paginator->settings['limit'] = Configure::read('site_limit');
		$this->Paginator->settings['conditions'] = array(
			'Article.status' => 'published'
		);
		$this->set('articles', $this->Paginator->paginate('Article'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug = null) {
        $article = $this->Article->find('first', array(
            'conditions' => array (
                'Article.slug' => $slug,
                'Article.status' => 'published'
            )
        ));
        if(!$article) {
            throw new NotFoundException();
        }
        $this->set('article', $article);

		// prevnext
		$prevnext = $this->Article->find('neighbors', array(
			'conditions' => array(
				'Article.status' => 'published'
            ),
			'recursive' => -1,
			'field' => 'Article.created',
            'value' => $article['Article']['created']
		));
        $this->set('prevnext', $prevnext);
	}

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Article->recursive = 1;
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = array(
			$this->Article->parseCriteria($this->Prg->parsedParams())
		);
		$this->set('articles', $this->Paginator->paginate('Article'));

		// status
		$total = $this->Article->find('count');
		$published = $this->Article->find('count', array(
			'conditions' => array(
				'Article.status' => 'published'
			)
		));
		$draft = $this->Article->find('count', array(
			'conditions' => array(
				'Article.status' => 'draft'
			)
		));
		$this->set(compact('total', 'published', 'draft'));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
				$this->Flash->success(__('The article has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Article->id));
			} else {
				$this->Flash->error(__('The article could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Article->Category->find('list');
		$tags = $this->Article->Tag->find('list');
		$this->set(compact('categories', 'tags'));
	}

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Article->save($this->request->data)) {
				$this->Flash->success(__('The article has been updated.'));
				return $this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Flash->error(__('The article could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
		$categories = $this->Article->Category->find('list');
		$tags = $this->Article->Tag->find('list');
		$this->set(compact('categories', 'tags'));
	}

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Flash->success(__('The article has been deleted.'));
		} else {
			$this->Flash->error(__('The article could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * dashboard_status method
 */
	public function dashboard_status($field = null, $id = null) {	
		$data = array('status' => $field, 'id' => $id);
		if ($this->Article->save($data)) {
			$this->Flash->success(__('The article has been update.'));
		} else {
			$this->Flash->error(__('The article could update.'));
		}
		return $this->redirect($this->referer());
	}
}
