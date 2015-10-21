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

// @todo Search box
echo $this->element('header-index', array('title' => 'Documentos', 'slug'=>'documents'));

echo $this->Bl->srow(array('class' => 'pages documents'));
	echo $this->Bl->sdiv(array('class' => "posts-list"), array());
		foreach ($mexc_documents as $document) {
			echo $this->Bl->sdiv(array('class' => "col-xs-12 col-sm-6 col-md-4"), array());
				echo $this->Bl->sdiv(array('class' => "post new"), array());
					echo $this->Jodel->insertModule('MexcNews.MexcNew', array('preview', 'box'), $document);
				echo $this->Bl->ediv();
			echo $this->Bl->ediv();
		}
		if (empty($mexc_documents)) {
			echo $this->Bl->sdiv(array('class' => "col-xs-12 col-sm-6 col-md-4"), array());
				echo $this->Bl->h5Dry("Não há documentos a exibir ainda");
			echo $this->Bl->ediv();
		}
	echo $this->Bl->ediv();
echo $this->Bl->erow();
