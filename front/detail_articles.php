<?php
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$join = array('cw_category', 'cw_article.categoryid=cw_category.id_category');
	if(!empty($id)) {
		$detail = $DB->getData('cw_article', 'cw_article.*, cw_category.category_name', array('id_article' => $id), $join);
		$random = $DB->getData('cw_article', 'cw_article.*, cw_category.category_name', array('id_article !=' => $id), $join, array('0','6'), 'RAND()');

		// paging 
		$page = isset($_GET['page']) ? ((int) $_GET['page']) : 1;
		$total_random = count($random);

		$pagination = (new Pagination());
		$pagination->setCurrent($page);
		$pagination->setTotal(12);

		// grab rendered/parsed pagination markup
		$markup_paging = $pagination->parse();

		if(is_null($detail)) {
			redirect();
		}
	} else {
		redirect();
	}
?>