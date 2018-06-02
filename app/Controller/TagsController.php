<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 * @property PaginatorComponent $Paginator
 */
class TagsController extends AppController {

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
            'Tag.created' => 'Desc',
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
        $tag = $this->Tag->find('first', array(
            'conditions' => array (
                'Tag.slug' => $slug,
            )
        ));
        if(!$tag) {
            throw new NotFoundException();
        }
        $this->set('tag', $tag);

        // article
        $this->loadModel('Article');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['joins'] = array(
            array(
                'table' => 'articles_tags',
                'alias' => 'ArticleTag',
                'conditions' => 'ArticleTag.article_id = Article.id',
            ),
            array(
                'table' => 'tags',
                'alias' => 'Tag',
                'conditions' => 'ArticleTag.tag_id = Tag.id',
            ),
        );
        $this->Paginator->settings['conditions'] = array(
            'Tag.slug' => $slug,
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
		$this->Tag->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('tags', $this->Paginator->paginate('Tag'));
	}

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
				$this->Flash->success(__('The tag has been saved.'));
				return $this->redirect(array('action' => 'edit', $this->Tag->id));
			} else {
				$this->Flash->error(__('The tag could not be saved. Please, try again.'));
			}
		}
		$articles = $this->Tag->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
		if (!$this->Tag->exists($id)) {
			throw new NotFoundException(__('Invalid tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tag->save($this->request->data)) {
				$this->Flash->success(__('The tag has been updated.'));
				return $this->redirect(array('action' => 'edit', $this->Tag->id));
			} else {
				$this->Flash->error(__('The tag could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
			$this->request->data = $this->Tag->find('first', $options);
		}
		$articles = $this->Tag->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
		$this->Tag->id = $id;

		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}

		$tag = $this->Tag->findById($id);
		if ($tag['Tag']['article_count'] >= '1') {
			$this->Flash->error(__('The tag with article count >= 1 could not be deleted.'));
			return $this->redirect(array('action' => 'index'));
		}

		$this->request->allowMethod('post', 'delete');

		if ($this->Tag->delete()) {
			$this->Flash->success(__('The tag has been deleted.'));
		} else {
			$this->Flash->error(__('The tag could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('action' => 'index'));
	}
}
