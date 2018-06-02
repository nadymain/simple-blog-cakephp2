<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

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
            'Category.created' => 'Desc',
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
        $category = $this->Category->find('first', array(
            'conditions' => array (
                'Category.slug' => $slug,
            )
        ));
        if(!$category) {
            throw new NotFoundException();
        }
        $this->set('category', $category);

        // article
        $this->loadModel('Article');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array(
            'Category.slug' => $slug,
            'Article.status' => 'published'
        );
        $this->Paginator->settings['order'] = array(
            'Article.created' => 'Desc',
            'Article.id' => 'Desc'
        );
        $this->Paginator->settings['limit'] = Configure::read('site_limit');
        $this->set('articles', $this->Paginator->paginate('Article'));
	}

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {
		$this->Category->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('categories', $this->Paginator->paginate('Category'));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Category->id));
			} else {
				$this->Flash->error(__('The category could not be saved. Please, try again.'));
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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('The category has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->Category->id));
			} else {
				$this->Flash->error(__('The category could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		$this->Category->id = $id;

		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}

		if ($id == '1') {
			$this->Flash->error(__('The category with id = 1 could not be deleted.'));
			return $this->redirect(array('action' => 'index'));
		}

		$category = $this->Category->findById($id);
		if ($category['Category']['article_count'] >= '1') {
			$this->Flash->error(__('The category with article count >= 1 could not be deleted.'));
			return $this->redirect(array('action' => 'index'));
		}

		$this->request->allowMethod('post', 'delete');

		if ($this->Category->delete()) {
			$this->Flash->success(__('The category has been deleted.'));
		} else {
			$this->Flash->error(__('The category could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('action' => 'index'));
	}
}
