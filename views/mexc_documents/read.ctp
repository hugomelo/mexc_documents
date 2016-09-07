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

	echo $this->element('header-read', array('title' => $document['MexcDocument']['name'], 'slug'=>'documents'));

	echo $this->Bl->floatBreak();
	echo $this->Bl->srow(array('class' => 'pages documents'));
		echo $this->Bl->hr(array('class' => 'col-xs-12'));
		
		echo $this->Bl->sdiv(array('class' => 'col-xs-12 col-md-3 meta'), array());
			echo $this->Bl->div(array(), array(), 
				br_strftime("%d de %B, %Y",strtotime($document['MexcDocument']['date']))
			);
			echo $this->Bl->div(array(), array(), 
				'por '.$document['MexcDocument']['author']
			);
			echo $this->Bl->hr(array('class' => 'meta'));
			if (isset($document['Tag'])) {
				foreach($document['Tag'] as $tag) {
					echo $this->Bl->anchor(array(), array('url' => '/tag/'.$tag['keyname']), $tag['name']);
					if ($tag != end($document['MexcDocument'])) echo ", ";
				}
				echo $this->Bl->hr(array('class' => 'meta'));
			}
		echo $this->Bl->ediv();

		echo $this->Bl->sdiv(array('class' => 'col-xs-12 col-md-9'), array());

			echo $this->Bl->sdiv(array('class' => 'main-file'), array());
				echo "<h2>Arquivo principal</h2>";
				if (isset($document['SfilStoredFile']['id']))
					echo $this->Jodel->insertModule('PieFile.PieFile', array('full', 'mexc_document'), $document);
			echo $this->Bl->ediv();

			echo "<h2>Sobre o documento</h2>";
			echo $this->Bl->srow(array('class' => ''));
				echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_document'), $document['MexcDocument']['content_stream_id']);
			echo $this->Bl->erow();
		echo $this->Bl->ediv();
		echo $this->Bl->hr(array('class' => 'col-xs-12'));

		if (!empty($document['MexcRelatedContent'])) {
			echo $this->Bl->h5(array('class' => 'related_content'), array(), 'Conteúdo relacionado');
			echo $this->Bl->sdiv(array('class' => 'col-xs-12 related_content'), array());
				echo $this->Jodel->insertModule('MexcRelated.MexcRelatedContent', array('full'), $document);
			echo $this->Bl->ediv();
		}
	echo $this->Bl->erow();
	
echo $this->Bl->ebox();
