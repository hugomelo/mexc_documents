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

class MexcDocument extends MexcDocumentsAppModel
{
	var $name = 'MexcDocument';

	var $order = 'document_date';
	
	var $actsAs = array(
		'Containable',
		'Tags.Taggable',
		'Dashboard.DashDashboardable', 
		'Status.Status' => array('publishing_status', 'display_level'),
		'JjUtils.Serializable' => array('field' => 'report_data'),
		'JjMedia.StoredFileHolder' => array('file_id'),
		'ContentStream.CsContentStreamHolder' => array(
			'streams' => array(
				'content_stream_id' => 'document'
			)
		),
		'MexcRelated.MexcHasRelatedContent' => array(
			'MexcDocuments.MexcDocument',
			'MexcGalleries.MexcGallery',
			'MexcEvents.MexcEvent',
			'MexcNews.MexcNew'
		)
	);

	var $belongsTo = array(
		'MexcSpace.MexcSpace',
		'MexcEvents.MexcEvent',
		'SfilStoredFile' => array(
			'className' => 'JjMedia.SfilStoredFile',
			'foreignKey' => 'file_id'
		)
	);

/**
 * Method used to validates the extra inputs
 * 
 * @access public
 * @return boolean If valid or not
 */
	function beforeValidate()
	{
		$valid = true;
		if (!empty($this->data[$this->alias]['report_data']))
		{
			foreach ($this->data[$this->alias]['report_data'] as $field => $value)
			{
				if (isset($value['content'][301]))
				{
					$msg = __d('mexc_document', 'O dado extra do documento %d tem mais de 300 caracteres.', true);
					$this->invalidate('report_data', sprintf($msg, $field+1));
					$valid = false;
				}
			}
		}
		return $valid;
	}

/**
 * Adequate find for burocrata actions
 * 
 * @access public
 */
	function findBurocrata($id)
	{
		$this->contain(array('Tag', 'MexcSpace', 'SfilStoredFile', 'MexcRelatedContent'));
		return $this->findById($id);
	}

/** 
 * Creates a blank row in the table. It is part of the backstage contract.
 * 
 * @access public
 * @return The result of save method
 */
	function createEmpty()
	{
		$data = array();
		$data[$this->alias]['publishing_status'] = 'draft';
		$data[$this->alias]['document_date'] = date('Y-m-d');
		
		return $this->save($data, false);
	}

/** 
 * The data that must be saved into the dashboard. Part of the Dashboard contract.
 *
 * @access public
 * @return array 
 */	
	function getDashboardInfo($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		if (empty($data))
			return null;
		
		$dashdata = array(
			'dashable_id' => $data[$this->alias][$this->primaryKey],
			'mexc_space_id' => $data[$this->alias]['mexc_space_id'],
			'dashable_model' => $this->name,
			'type' => 'document',
			'status' => $data[$this->alias]['publishing_status'],
			'created' => $data[$this->alias]['created'],
			'modified' => $data[$this->alias]['modified'], 
			'name' => $data[$this->alias]['name'],
			'info' => 'Autor: ' . $data[$this->alias]['author'],
			'idiom' => array()
		);
		
		return $dashdata;
	}
}
