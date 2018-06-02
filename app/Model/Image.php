<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 */
class Image extends AppModel {

/**
 * actsAs
 */
    public $actsAs = array(
        'Upload.Upload' => array(
            'file' => array(
            	'pathMethod' => 'flat',
            	'path' => '{ROOT}webroot{DS}img{DS}uploads{DS}',
            	'thumbnailPath' => '{ROOT}webroot{DS}img{DS}uploads{DS}thumb{DS}',
            	'thumbnailMethod' => 'php',
				'thumbnailQuality' => '100',
				'thumbnailSizes' => array(
					's' => '120mw'
				),
				'nameCallback' => 'fileRename',
            ),
        ),
        'Search.Searchable',
    );

/**
 * fileRename
 */
	public function fileRename($field, $currentName) {
        $filename = pathinfo($currentName, PATHINFO_FILENAME);
        $filename = Inflector::slug($filename, '-');
		$ext = pathinfo($currentName, PATHINFO_EXTENSION);
		
        return strtolower($filename) . '-' . date('dmyHis') . '.' . $ext;
	}

/**
 * filterArgs
 */
	public $filterArgs = array(
		'file' => array(
			'type' => 'like',
			'field' => 'file'
		),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'file' => array(
			'isBelowMaxSize' => array(
				'rule' => array('isBelowMaxSize', 900000),
				'message' => 'File is larger than the maximum filesize 900 KB.'
			),
			'isValidExtension' => array(
				'rule' => array('isValidExtension', array('jpg', 'gif', 'png')),
				'message' => 'Image does not have a jpg, png, and gif extension.'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'File image already taken, must be unique.'
			),
		),
	);
}
