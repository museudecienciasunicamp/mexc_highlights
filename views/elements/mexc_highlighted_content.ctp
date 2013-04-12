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
 * @link          https://github.com/museudecienciasunicamp/mexc_highlights.git Mexc Highlights public repository
 */

switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->element('mexc_highlighted_content_form', array('plugin' => 'mexc_highlights'));
			break;
		}
	break;
	
	case 'list':
		switch ($type[1])
		{
			case 'main_page':
				foreach ($highlighted as $high)
				{
					echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'hatched_cloud'));
					echo $this->Jodel->insertModule('MexcHighlights.MexcHighlightedContent', array('view'), $high);
					echo $this->Bl->ebox();
				}
			break;
			case 'site_factory':
				foreach ($highlighted as $high)
				{
					echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1, 'm' => -1), 'type' => 'hatched_cloud'));
					echo $this->Jodel->insertModule('MexcHighlights.MexcHighlightedContent', array('view'), $high);
					echo $this->Bl->ebox();
				}
			break;
		}
	break;
	
	case 'view':
		echo $this->Bl->sdiv(array('class' => 'mexc_highlight'));
			if (!empty($data['MexcHighlightedContent']['title']))
			{
				$title = $data['MexcHighlightedContent']['title'];
				if (!empty($data['MexcHighlightedContent']['title_link']))
					$title = $this->Bl->a(array('class' => 'visitable', 'href' => $data['MexcHighlightedContent']['title_link']), array(), $title);
				echo $this->Bl->h3Dry($title);
			}
			
			if (!empty($data['MexcHighlightedContent']['img_id']))
			{
				echo $this->Bl->img(array(), array('id' => $data['MexcHighlightedContent']['img_id'], 'version' => 'version'));
			}
			
			if (!empty($data['BodyTextile']['html']))
			{
				echo $data['BodyTextile']['html'];
			}
		echo $this->Bl->ediv();
	break;
}
