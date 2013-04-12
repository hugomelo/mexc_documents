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
echo $this->Bl->sbox(array(), array('size' => array('M' => 12, 'g' => -1), 'type' => 'cloud'));
	
	echo $this->Bl->h2Dry('documentos');
	
	echo $this->element('pagination', array('top' => true));
	
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
	
		$total_documents = count($documents);
		foreach ($documents as $cont => $document)
		{
			echo $this->Jodel->insertModule('MexcDocuments.MexcDocument', array('column_full'), $document);
			
			if (($cont+1) % 3 == 0)
			{
				echo $this->Bl->floatBreak();
				if ($cont+1 < $total_documents)
					echo  $this->Bl->box(
							array(), 
							array('size' => array('M' => 12, 'g' => -1), 'type' => 'inner_column'),
							$this->Bl->hr()
						);
			}
		}
		
		echo $this->Bl->floatBreak();
		echo $this->Bl->br();
	echo $this->Bl->eboxContainer();
	
	echo $this->element('pagination');

echo $this->Bl->ebox();

echo $this->Bl->br();
