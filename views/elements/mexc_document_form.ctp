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

echo $this->Buro->sform(array(), array(
	'model' => $fullModelName,
	'callbacks' => array(
		'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
		'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading()'),
		'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
		'onSave' => array('js' => '$("content").scrollTo(); showPopup("notice");'),
	)
));

	echo $this->Buro->input(
		array(), 
		array('fieldName' => 'id', 'type' => 'hidden')
	);
	
	// Mexc space
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'mexc_space'
		)
	);
	
	// Display Level
	//echo $this->Buro->input(
		//array(),
		//array(
			//'fieldName' => 'display_level',
			//'type' => 'select',
			//'label' => __d('mexc_document', 'form - display level label', true),
			//'instructions' => __d('mexc_document', 'form - display level instructions', true),
			//'options' => array('options' => array (
				//'general' => 'Geral',
				//'fact_site' => 'Só no espaço',
				//'private' => 'Privado'
			//))
		//)
	//);
	
	// Document name
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'name',
			'type' => 'text',
			'label' => __d('mexc_document', 'form - name label', true),
			'instructions' => __d('mexc_document', 'form - name instructions', true)
		)
	);
	
	// Author
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'author',
			'type' => 'text',
			'label' => __d('mexc_document', 'form - author label', true),
			'instructions' => __d('mexc_document', 'form - author instructions', true)
		)
	);
	
	// Document tags
	echo $this->Buro->input(array(), 
		array(
			'type' => 'tags',
			'fieldName' => 'tags',
			'label' => __d('mexc_document', 'form - tags input label', true),
			'instructions' => __d('mexc_document', 'form - tags input instructions', true),
			'options' => array(
				'type' => 'comma'
			)
		)
	);
	
	// Summary
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'summary',
			'type' => 'textarea',
			'label' => __d('mexc_document', 'form - summary label', true),
			'instructions' => __d('mexc_document', 'form - summary instructions', true)
		)
	);

	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'file_id',
			'type' => 'upload',
			'label' => __d('mexc_document', 'form - file label', true), 
			'instructions' => __d('mexc_document', 'form - file instructions', true)
		)
	);
	
	// Content stream
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'content_stream',
			'label' => __d('mexc_document', 'form - content_stream label', true),
			'instructions' => __d('mexc_document', 'form - content_stream instructions', true),
			'options' => array(
				'foreignKey' => 'content_stream_id'
			)
		)
	);
	
	// Related contents
	echo $this->Buro->inputMexcRelatedContent();
	
	echo $this->Buro->submitBox(array(),array('publishControls' => false));
echo $this->Buro->eform();
