<?php 
	$join = array('cw_category', 'cw_article.categoryid=cw_category.id_category');

	$primary_article = $DB->getData('cw_article', 'cw_article.*,cw_category.category_name', null, $join, array(0, 5), 'id_article DESC');

	$secondary_article = $DB->getData('cw_article', 'cw_article.*,cw_category.category_name', null, $join, array(5, 13), 'id_article DESC');

	if(isset($_POST['search']))
	{
		$query = strip_tags(trim(mysql_escape_string($_POST['query'])));
		echo '<script>window.location.href="http://commlife.co.id/Search?q='.$query.'"</script>';
	}
?>