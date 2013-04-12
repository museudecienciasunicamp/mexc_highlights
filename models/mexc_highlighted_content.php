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

class MexcHighlightedContent extends MexcHighlightsAppModel
{
	var $name = 'MexcHighlightedContent';
	
	var $actsAs = array(
		'Containable',
		'Dashboard.DashDashboardable', 
		'Status.Status' => array('publishing_status'),
		'JjMedia.StoredFileHolder' => array('img_id'),
	);
	
	
	var $belongsTo = array(
		'BodyTextile' => array(
			'className' => 'MexcTextile.MexcTextileText',
			'foreignKey' => 'text_textile_id'
		),
		'MexcSpace' => array(
			'className' => 'MexcSpace.MexcSpace'
		)
	);

/**
 * Returns the $limit firsts rows of an space
 * 
 * @access public
 * @param string $mexc_space_id The MexcSpace id
 * @param int $limit How much rows will retreive (max)
 * @return mixed The result of the Model::find('all')
 */
	function getHightlightedsFrom($mexc_space_id, $limit = 3)
	{
		return $this->find('all', array(
			'contain' => array('BodyTextile'),
			'conditions' => array(
				'MexcHighlightedContent.mexc_space_id' => $mexc_space_id,
				'MexcHighlightedContent.best_before >= NOW()'
			),
			'order' => array(
				'MexcHighlightedContent.weight' => 'DESC', 
				'MexcHighlightedContent.best_before' => 'ASC',
				'MexcHighlightedContent.created' => 'ASC'
			),
			'limit' => 3
		));
	}

	function findBurocrata($id)
	{
		$this->contain('BodyTextile', 'MexcSpace');
		return $this->findById($id);
	}
	
	function saveBurocrata($data)
	{
		return $this->saveAll($data);
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
		$data[$this->alias]['best_before'] = date('Y-m-d H:i:s', strtotime('+10 days'));
		
		$this->BodyTextile->createEmpty();
		$data[$this->alias]['text_textile_id'] = $this->BodyTextile->id;
		
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
			'type' => 'highlight',
			'status' => $data[$this->alias]['publishing_status'],
			'created' => $data[$this->alias]['created'],
			'modified' => $data[$this->alias]['modified'], 
			'name' => 'Até: ' . date('d/m/y', strtotime($data[$this->alias]['best_before'])),
			'info' => 'Desc.: ',
			'idiom' => array()
		);
		
		return $dashdata;
	}

/**
 * 
 * 
 * @access 
 */
	function dashDelete($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		$this->BodyTextile->delete($data['MexcHighlightedContent']['text_textile_id']);
		return $this->delete($id);
	}
}
