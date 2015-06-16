<?php

class SearchTweaksPlugin extends Omeka_Plugin_AbstractPlugin
{
	protected $_filters = array('public_navigation_items');
	protected $_hooks = array('admin_items_search', 'public_items_search');

	function filterPublicNavigationItems($nav)
	{
/*		$nav_slice = array();
		$nav_slice['BrowseByCollection'] = array('label' => 'Browse by Collection', 'uri' => url('collections/browse'));
		$nav_slice['BrowseByExhibit'] = array('label' => 'Browse by Exhibit', 'uri' => url('exhibits/browse'));
		$nav_slice['BrowseByTest'] = array('label' => 'Browse by test', 'uri' => url('items/search?q=perch'));

		//	munge in our nav options before the search link
		array_splice( $nav, 2, 0, $nav_slice ); */
		return $nav;
	}

	public function hookAdminItemsSearch($args)
    {
        $view = $args['view'];
		
        echo $view->partial('search-subject-partial.php', array(
									'subjects' => $this->listSubjects(),
									'subject_element_id' => $this->getDcSubjectId(),
									'subject_match_type' => 'contains',
		));
	}

    public function hookPublicItemsSearch($args)
    {
        $view = $args['view'];
		
        echo $view->partial('search-subject-partial.php', array(
									'subjects' => $this->listSubjects(),
									'subject_element_id' => $this->getDcSubjectId(),
									'subject_match_type' => 'contains',
		));
    }
	
	public function getDcSubjectId()
	{
		$db = get_db();
		$sql = "
			SELECT	e.id
			FROM	{$db->Elements} e
			WHERE	e.name = 'Subject'
			AND 	e.element_set_id = (
				SELECT id
				FROM {$db->ElementSets} es
				WHERE es.name = 'Dublin Core'
			)";
		
		$result = $db->fetchOne($sql);
		return $result;
	}
	
	public function listSubjects()
	{
		$db = get_db();
		$sql = "
			SELECT DISTINCT et.text
			FROM {$db->ElementTexts} et
			JOIN {$db->Elements} e
			ON et.element_id = e.id
			WHERE e.name = 'Subject'
			AND e.element_set_id = (
				SELECT id
				FROM {$db->ElementSets} es
				WHERE es.name = 'Dublin Core'
			)
			ORDER BY et.text";
		
		$result = $db->fetchAll($sql);

		$subjects = array('' => 'Select Below');
		foreach ($result as $row)
		{
			$subject = trim($row['text']);
			$subjects[$subject] = $subject;
		}
		
		return $subjects;
	}
}
