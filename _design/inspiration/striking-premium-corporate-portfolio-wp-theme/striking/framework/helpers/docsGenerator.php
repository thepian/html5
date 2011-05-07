<?php
/**
 * The `docsGenerator` class help generate the html code for theme documentation page.
 */
class docsGenerator {
	var $title;
	var $docs;
	
	/**
	 * Constructor
	 * 
	 * @param array $docs
	 */
	function docsGenerator($title,$docs) {
		wp_print_scripts('theme-docs');
		$this->title = $title;
		$this->docs = $docs;
		
		$this->render();
	}
	
	function render() {
		echo '<div class="wrap theme-docs-page">';
		echo '<h2>'.$this->title.'</h2>';
		
		echo '<div id="theme-docs-tabs"><ul class="theme-docs-tabs">';
		foreach($this->docs as $docs) {
			echo '<li><a href="#'.$docs['section'].'">'.$docs['name'].'</a><span></span></li>';
		}
		echo '</ul>';
		foreach($this->docs as $docs) {
			$this->renderSection($docs['section']);
		}
		echo '<div class="clear"></div>';
		echo '</div>';
		echo '</div>';
	}
	
	function renderSection($section) {
		echo '<div id="'.$section.'" class="block">';
		include THEME_ADMIN_DOCS.'/'.$section.'.php';
		echo '<div class="clear"></div>';
		echo '</div>';
	}
}
