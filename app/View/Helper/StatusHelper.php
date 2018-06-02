<?php
App::uses('AppHelper', 'View/Helper');

class StatusHelper extends AppHelper {

    public $helpers = ['Form'];

    public function update($status, $id)
    {
        $published = $this->Form->postLink(__('Published'), 
            array('action' => 'status', 'draft', $id), 
            array('title' => 'Change Status')
        );

        $draft = $this->Form->postLink(__('Draft'), 
            array('action' => 'status', 'published', $id), 
            array('class' => 'draft', 'title' => 'Change Status')
        );
        
        return $status == 'published' ? $published : $draft;
    }

}