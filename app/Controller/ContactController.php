<?php
App::uses('AppController', 'Controller');
/**
 * ContactController
 */
class ContactController extends AppController {
    
/**
 * helpers
 */
    public $helpers = array('Form');

/**
 * index
 */ 
    public function index() {
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Contact']['website'])) {
                $this->Flash->success('Contact form was submitted successfully');
                return $this->redirect(array('action' => 'index'));
            } 

            if ($this->Contact->_execute($this->request->data['Contact'])) {
                $this->Flash->success('Contact form was submitted successfully');
                $this->request->data = array();
            } else {
                $this->Flash->error('Somethings not right.');
            }
        }
    }
    
}