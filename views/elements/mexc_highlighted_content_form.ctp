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
		array(
			'fieldName' => 'id',
			'type' => 'hidden'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'mexc_space'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'text',
			'fieldName' => 'title',
			'label' => __d('mexc_highlights', 'form - title label', true),
			'instructions' => __d('mexc_highlights', 'form - title instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'text',
			'fieldName' => 'title_link',
			'label' => __d('mexc_highlights', 'form - title_link label', true),
			'instructions' => __d('mexc_highlights', 'form - title_link instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'img_id',
			'type' => 'image',
			'label' => __d('mexc_highlights', 'form - image label', true),
			'instructions' => __d('mexc_highlights', 'form - image instructions', true),
			'options' => array(
				'version' => 'version'
			)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'related_textile',
			'label' => __d('mexc_highlights', 'form - text (textile) label', true),
			'instructions' => __d('mexc_highlights', 'form - text (textile) instructions', true),
			'options' => array(
				'assocName' => 'BodyTextile',
				'enabled_buttons' => array('italic', 'bold', 'link')
			)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'best_before',
			'type' => 'datetime',
			'options' => array(
				'dateFormat' => 'DMY',
				'timeFormat' => false,
				'separator' => '',
				'minYear' => date('Y')-1,
				'maxYear' => date('Y')+3
			),
			'label' => __d('mexc_highlights', 'form - best_before label', true),
			'instructions' => __d('mexc_highlights', 'form - best_before instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'weight',
			'type' => 'text',
			'label' => __d('mexc_highlights', 'form - weight label', true),
			'instructions' => __d('mexc_highlights', 'form - weight instructions', true),
			'options' => array(
				'value' => 1
			)
		)
	);
	
	echo $this->Buro->submitBox(array(),array('publishControls' => false));
echo $this->Buro->eform();
