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

switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->element('mexc_document_form', array('plugin' => 'mexc_documents'));
			break;
		}
	break;
	
	case 'column':
		if ($type[1] == 'related_content')
		{
			echo $this->Bl->sdiv();
				echo $this->Bl->anchor(
					array('class' => 'visitable'), 
					array(
						'url' => array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'read', $data['MexcDocument']['id']),
						'space' => $data['MexcDocument']['mexc_space_id']
					),
					$data['MexcDocument']['name']
				);
			echo $this->Bl->ediv();
		}
	break;
	
	case 'column_full':
		echo  $this->Bl->sbox(array('class' => 'document_full_preview'), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
			
			if ($currentSpace != $data['MexcDocument']['mexc_space_id'])
				echo $this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcDocument']['mexc_space_id']));
			
			echo $this->Bl->anchor(
					array('class' => 'visitable'),
					array(
						'url' => array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'read', $data['MexcDocument']['id']),
						'space' => $data['MexcDocument']['mexc_space_id']
					),
					$data['MexcDocument']['name']
				);
			
			$created = strtotime($data['MexcDocument']['document_date']);
			$modified = strtotime($data['MexcDocument']['modified']);
			echo $this->Bl->p(array('class' => 'small'),array(), __d('mexc_document', sprintf('Criado por %s em %s.', $data['MexcDocument']['author'], date('d/n/Y', $created)), true));
			if ($created+DAY < $modified)
				echo $this->Bl->p(array('class' => 'small'),array(), __d('mexc_document', sprintf('Modificado em %s.', date('d/n/Y', $modified)), true));
			
			if (!empty($data['Tag']))
				echo $this->Bl->tagList(array('class' => 'small'), array('tags' => $data['Tag'], 'before' => 'Palavras-chave'));
			
			if (!empty($data['SfilStoredFile']['id']))
				echo $this->Jodel->insertModule('PieFile.PieFile', array('full', 'mexc_document'), $data);
			
			if (!empty($data['MexcDocument']['summary']))
				echo $this->Bl->paraDry(explode("\n", $data['MexcDocument']['summary']));
			
			echo $this->Bl->floatBreak();
		echo $this->Bl->ebox();
	break;
	
	case 'column_grande_desafio':
			
		if (!empty($data['SfilStoredFile']['id']))
			echo $this->Jodel->insertModule('PieFile.PieFile', array('full', 'mexc_document'), $data);
		
		if (!empty($data['MexcDocument']['summary']))
			echo $this->Bl->paraDry(explode("\n", $data['MexcDocument']['summary']));
			
		$created = strtotime($data['MexcDocument']['document_date']);
		$modified = strtotime($data['MexcDocument']['modified']);
		echo $this->Bl->p(array('class' => 'small'),array(), __d('mexc_document', sprintf('Criado por %s em %s.', $data['MexcDocument']['author'], date('d/n/Y', $created)), true));
		if ($created+DAY < $modified)
			echo $this->Bl->p(array('class' => 'small'),array(), __d('mexc_document', sprintf('Modificado em %s.', date('d/n/Y', $modified)), true));
		
		
		
		echo $this->Bl->floatBreak();

	break;
	
	case 'column_fact_site':
		echo $this->Bl->anchor(
			array('class' => 'visitable'),
			array(
				'url' => array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'read', $data['MexcDocument']['id']),
				'space' => $data['MexcDocument']['mexc_space_id']
			),
			$data['MexcDocument']['name']
		);
		
		echo $this->Bl->br();
		echo $this->Bl->sspan();
			echo '<b>Data</b>&nbsp;', date('d/n/Y', strtotime($data['MexcDocument']['document_date'])), '&emsp;',
				 '<b>Autor</b>&nbsp;',str_replace(' ','&nbsp;',$data['MexcDocument']['author']),'&emsp;',
				 '<b>Tipo</b>&nbsp;', str_replace(' ','&nbsp;',$data['MexcDocument']['document_type']);
		echo $this->Bl->espan();
		
		echo $this->Bl->pDry($data['MexcDocument']['summary']);
		echo $this->Bl->br();
	break;
	
	case 'full':
		
		// Title, space and tag list
		$space_tag = '';
		if ($currentSpace != $data['MexcDocument']['mexc_space_id'])
			$this->Bl->mexcSpaceTag(array(), array('space_id' => $data['MexcDocument']['mexc_space_id']));
		echo $this->Bl->h2Dry($data['MexcDocument']['name'] . $space_tag);
		
		if (isset($data['Tag']))
			echo $this->Bl->tagList(array(),array('tags' => $data['Tag']));
		echo $this->Bl->hr(array('class' => 'double'));
		
		echo $this->Bl->sboxContainer(array('class' => 'document_full'), array('size' => array('M' => 9), 'type' => 'column_container'));
			
			// Main content
			echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Bl->sdiv(array('class' => 'document_body'));
				
					if (isset($data['SfilStoredFile']['id']))
						echo $this->Jodel->insertModule('PieFile.PieFile', array('full', 'mexc_document'), $data);
				
					echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_document'), $data['MexcDocument']['content_stream_id']);
				echo $this->Bl->ediv();
				
				echo $this->Bl->hr();
				
				echo $this->element('social_medias', array('plugin' => false, 'module' => 'MexcDocument'));
			echo $this->Bl->ebox();
			
			// Sidebar
			echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Bl->br();
				echo $this->Bl->sp();
					$created = strtotime($data['MexcDocument']['document_date']);
					$modified = strtotime($data['MexcDocument']['modified']);
					
					echo $this->Bl->span(array('class' => 'label'), array(), __d('mexc_document', 'Data', true)),
						'&ensp;', date('d/n/Y', $created), $this->Bl->br();
					
					if ($created+DAY < $modified)
						echo $this->Bl->span(array('class' => 'label'), array(), __d('mexc_document', 'Última atualização', true)),
							'&ensp;', date('d/n/Y', $modified), $this->Bl->br();
					
					echo $this->Bl->span(array('class' => 'label'), array(), __d('mexc_document', 'Autor', true)),
						'&ensp;', h($data['MexcDocument']['author']), $this->Bl->br();
					
					echo $this->Bl->span(array('class' => 'label'), array(), __d('mexc_document', 'Tipo', true)),
						'&ensp;', $data['MexcDocument']['document_type'], $this->Bl->br();
					
					$cleaned = Set::filter(Set::extract('/MexcDocument/report_data/label', $data));
					if (!empty($cleaned))
					{
						echo $this->Bl->hr(array('class' => 'dotted'));
						foreach ($data['MexcDocument']['report_data'] as $report)
						{
							if (!empty($report['label']))
								echo $this->Bl->span(array('class' => 'label'), array(), $report['label']),
									'&ensp;', $report['content'], $this->Bl->br();
						}
					}
					
				echo $this->Bl->ep();
				
			echo $this->Bl->ebox();
			
		echo $this->Bl->eboxContainer();
		echo $this->Bl->floatBreak();
	break;
}
