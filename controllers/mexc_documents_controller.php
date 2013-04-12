<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_documents.git Mexc Documents public repository
 */

class MexcDocumentsController extends MexcDocumentsAppController
{
	var $name = 'MexcDocuments';
	var $uses = array('MexcDocuments.MexcDocument');
	var $paginate = array(
		'MexcDocument' => array(
			'limit' => 6,
			'contain' => array('SfilStoredFile', 'Tag')
		)
	);

/**
 * action beforeFilter
 * 
 * @access private
 * @return void 
 */
	function beforeFilter()
	{
		parent::beforeFilter();
		if (!empty($this->currentSpace))
			$this->MexcDocument->setActiveStatuses(array('display_level' => array('general', 'fact_site')));
		else
			$this->MexcDocument->setActiveStatuses(array('display_level' => array('general')));
	}
	
	function index()
	{
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$documents = $this->paginate('MexcDocument', $conditions);
		$this->set(compact('documents'));
	}
	
	function read($mexc_document_id = null)
	{
		if (empty($mexc_document_id))
			$this->cakeError('error404');
		
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$document = $this->MexcDocument->find('first', array(
			'contain' => array('Tag', 'SfilStoredFile'),
			'conditions' => array(
				'MexcDocument.id' => $mexc_document_id,
			) + $conditions
		));
		
		if (empty($document))
			$this->cakeError('error404');
		
		$this->SectSectionHandler->addToPageTitleArray(array(null, null, $document['MexcDocument']['name']));
		
		$this->set(compact('document'));
	}
}
