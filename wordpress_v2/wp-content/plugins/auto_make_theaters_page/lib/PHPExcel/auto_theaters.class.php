<?php


/**
 
	 Copyright 2014 Global IT Academy  (email : tokikawa@globalit-academy.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
	@author Time River Design Inc.
	@link tokikawa@globalit-academy.com
	@copyright Global IT Academy

*/


class AutoTheater {
	
	private $html;
	private $data_r;
	private $links;
	private $title_lists;
	private $sections;
	private $sections_index;
	
	
	private $___a = false;
	private $___b = false;	
	private $___c = false;	
	
	public function __construct($file_path=null){
		$this->sections = array(array());
		$this->sections_index = -1;
		$this->title_lists = array();
		$file_path!=null && $this->data_r = readXlsx($file_path);
	}
	

	
	/**
	 * 	Method which will read an <strong>xlsx</strong> file using the <em>PHP Excel library</em>.
	 * 
	 * @param String $file_path
	 * @return String[]
	 */
	
	public function readXlsx($file_path)
	{
	
		require_once dirname(__FILE__) . '/PHPExcel/IOFactory.php';
		if (!file_exists($file_path)) {
			exit($file_path. "not found . ");
		}
		$objPExcel = PHPExcel_IOFactory::load($file_path);
		$this->data_r = $objPExcel->getActiveSheet()->toArray(null,true,true,true);
	}
	
	/**
	 * 	The method which you can use to output the resulting html from the passed data processed by <strong>process()</strong> method.
	 * 	Before returning the output, all the sections will be combined first using the <strong>combineSections()</strong> method.
	 * 
	 * @return String
	 */
	public function getHtml(){
		$this->process();
		return $this->combineSections($this->sections);
	}
	
	
	/**
	 * 
	 * An internally used method which processes the data from <strong>readXlsx()</strong> method. 
	 * The processed data will be segregated into their own section instance. And can be combined later
	 * using the <strong>combineSections()</strong> method.
	 *
	 * @param String $file_path
	 * @return void
	 */
	private function process(){
		$data = $this->data_r;
		
		foreach ($data as $key => $value) {
			switch ($value['A']) {
				case 'links':
						
					// IMPORTANT:
					// since we are storing the links in an array, we should increment it by one after each cycle
					$this->sections_index++;
						
					$this->sections[$this->sections_index][] =  $this->getLinksHtml($value);
					break;
				case 'title':
						
					// IMPORTANT:
					// since links occurs only once, but the links should appear on every section,
					// this condition will make sure that the links will not appear twice.
					if (!$this->___a){
						$this->___a = true;
					} else {
						// since we are storing the links in an array, we should increment it by one after each cycle
						$this->sections_index++;
					}
						
					$this->sections[$this->sections_index][] = $this->getTitleHtml($value);
					break;
				case 'header':
					$this->sections[$this->sections_index][] = $this->getHeaderHtml($value);
					break;
				case 'row':
					$this->sections[$this->sections_index][] = $this->getRowHtml($value);
					break;
				default:
					break;
			}
		}
		
	}
	
	
	
	
	
	/**
	 * 	An internally used method.
	 * 	The data passed will be processed and wrapped inside a container for link type of data.
	 *
	 * @param String[] $array
	 * @return String
	 */
	private function getLinksHtml($array) {
		// remove the identifier
		array_shift($array);
		// extract the values from the array
		$array = array_values($array);
	
		// some local variables
		$links = array();
		$li = 0;
	
		for ($i=0;$i<count($array);$i+=2) {
			$links[$li] = "\n\t\t\t<a href=\"".$array[$i+1]."\">".$array[$i]."</a>";
			$li++;
		}
	
		// connect the results
	
		if (!$this->___b) {
			$this->___b = true;
			$str_buffer = "\t\t<div align=\"center\" class=\"arealist-top\">";
		} else {
			$str_buffer = "\t\t<div align=\"center\" class=\"arealist\">";
		}
	
		$str_buffer .= implode("　｜　",$links);
		$str_buffer .= "\n\t\t</div>\n";
	
	
		$this->links = $str_buffer;
	
		// return the html string
		return  $str_buffer;
	
	}
	
	
	
	/**
	 * 
	 * 	An internally used method.
	 * 	The data passed will be processed and wrapped inside a container for title type of data.
	 *
	 * @param String[] $array
	 * @return String
	 */
	private function getTitleHtml($array) {
		// remove the identifier
		array_shift($array);
		$array = array_values($array);
	

			$this->title_lists[] = array($array[1],$array[0]);

	
		$str_buffer = "";
		if (!$this->___c) {
			$this->___c = true;
		} else {
			$str_buffer .= $this->links;
		}
	
	
	
		return $str_buffer;
	}
	
	
	
	/**
	 * 
	 * 	An internally used method.
	 * 	The data passed will be processed and wrapped inside a container for header type of data.
	 *
	 * @param String[] $array
	 * @return String
	 */
	function getHeaderHtml($array) {
		array_shift($array);
		$array = array_filter(array_values($array));
	
		$str_buffer = "\t\t<section class=\"article-container\">\n";
		$str_buffer .= "\t\t\t<article class=\"top-heads clearfix\" >\n";
		$e=1;
		for ($i=0;$i<=count($array);$i++) {
			if ( @$array[$i] != null ) {
				$e==4&&$e++;
				$str_buffer .= "\t\t\t\t<p class=\"t".$e."\">".$array[$i]."</p>\n";
				$e++;
			}
		}
		$str_buffer .= "\t\t\t</article>\n";
		$str_buffer .= "\t\t</section>\n";
	
		return $str_buffer;
	}
	
	
	/**
	 * 
	 * 	An internally used method.
	 * 	The data passed will be processed and wrapped inside a container for row type of data.
	 * 
	 * @param String[] $array
	 * @return String
	 */
	function getRowHtml($array) {
		// remove the identifier
		array_shift($array);
		$array = array_values($array);
	
	
		$str_buffer = "\t\t\t<article class=\"clearfix\">\n";
		$str_buffer .= "\t\t\t\t<p class=\"t1\">".$array[0]."</p>\n";
		$str_buffer .= "\t\t\t\t<p class=\"t2\"><a href=\"".$array[2]."\" target=\"_blank\">".$array[1]."</a></p>\n";
		$str_buffer .= "\t\t\t\t<p class=\"t3\">".$array[3]."</p>\n";
		$e = 5;
		for ($i=4;$i<count($array);$i++) {
			if ($array[$i] != null ) {
				$str_buffer .= "\t\t\t\t<p class=\"t".$e."\">".$array[$i]."</p>\n";
				$e++;
			}
		}
		$str_buffer .= "\t\t\t</article>\n";
	
	
		return $str_buffer;
	}
	
	
	/**
	 *	An internally used method.
	 * 	Combines all the sections that was stored in an array
	 * 	After combining, they will be wrapped inside the "section-container" and returned as string.
	 *
	 *
	 * @param String[] $array
	 * @return String
	 */
	private function combineSections($array){
	
		$str_buffer = "<section id=\"section-container\">\n";
		$str_buffer .= "\t<div id=\"social-container\" class=\"clearfix\"></div>\n";
		$str_buffer .= "\t<p id=\"warning\"></p>\n";
	
	
		$headers = array();
		for ($i=0;$i<count($this->title_lists);$i++) {
			for ($e=0;$e<count($array[$i]);$e++) {
				if ( strpos($array[$i][$e], "\t\t<section class=\"article-container\">\n") === 0 ) {
					$headers[] = $array[$i][$e];
				}
			}
		}
	
		for ($i=0;$i<count($this->title_lists);$i++) {
	
			$title = $this->title_lists[$i];
	
			$id = preg_replace("/#(.*)/", "$1", $title[0]);
			$label = $title[1];
	
			$rows = array();
	
			for ($e=0;$e<count($array[$i]);$e++) {
				$str = $array[$i][$e];
					
				if ( strpos($str, "\t\t\t<article class=\"clearfix\">\n") === 0 ) {
					$rows[] = $str;
				} else if ( strpos($str, "\t\t<section class=\"article-container\">\n") === 0 ) {
	
				} else {
					$str_buffer .= $array[$i][$e];
				}
			}
	
			$str_buffer .= $headers[$i];
			$str_buffer .= "\t\t<section id=\"".$id."\">\n";
			$str_buffer .= "\t\t<article class=\"top-heads clearfix\">\n";
			$str_buffer .= "\t\t\t<p class=\"areatxt\">".$label."</p>\n";
			$str_buffer .= "\t\t</article>\n";
			$str_buffer .= implode("\n", $rows);
			$str_buffer .= "\t</section>\n";
		}
	
		$str_buffer .= "</section>\n";
	
		return $str_buffer;
	}
	

	
	
	
}






