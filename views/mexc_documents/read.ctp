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

echo $this->Bl->sbox(array(), array('size' => array('M' => 9, 'g' => -1), 'type' => 'cloud'));

	echo $this->Jodel->insertModule('MexcDocuments.MexcDocument', array('full'), $document);
	
	echo $this->Bl->hr(array('class' => 'double'));
	
	// @todo Thread of comments.
	
echo $this->Bl->ebox();

echo $this->Bl->sbox(array('class' => 'more_content'), array('type' => 'sky', 'size' => array('M' => 3, 'g' => -1)));
	// @todo Link to the right place
	echo $this->Bl->anchor(
		array('class' => 'non_visitable'), 
		array('url' => array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'index')),
		'Outros documentos da Rede'
	);
echo $this->Bl->ebox();
