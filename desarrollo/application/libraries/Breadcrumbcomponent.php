<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Breadcrumbcomponent {

    private $_include_home = 'Inicio';
    private $_breadcrumb = array();
    private $_divider = '<font color="#666666"><b>&nbsp;/&nbsp;</b></font>';
    private $_container_open = '<div id="migaDePan">&nbsp;&nbsp;&nbsp;&nbsp;';
    private $_container_close = '</div>';
    private $_crumb_open = '';
    private $_crumb_close = '';

    public function __construct() {
        $CI = & get_instance();
        $CI->load->helper('url');
        /*if (isset($this->_include_home) && (sizeof($this->_include_home) > 0)) {
            $this->_breadcrumb[] = array('title' => $this->_include_home, 'href' => rtrim(base_url(), '/'));
        }*/
    }

    public function add($title = NULL, $href = '', $segment = FALSE) {
        // if the method won't receive the $title parameter, it won't do anything to the $_breadcrumb
        if (is_null($title))
            return;
        // first let's find out if we have a $href
        if (isset($href) && strlen($href) > 0) {
            // if $segment is not FALSE we will build the URL from the previous crumb
            if ($segment) {
                $previous = $this->_breadcrumb[sizeof($this->_breadcrumb) - 1]['href'];
                $href = $previous . '/' . $href;
            }
            // else if the $href is not an absolute path we compose the URL from our site's URL
            elseif (!filter_var($href, FILTER_VALIDATE_URL)) {
                $href = site_url($href);
            }
        }
        // add crumb to the end of the breadcrumb
        $this->_breadcrumb[] = array('title' => $title, 'href' => $href);
    }

    public function output() {
        // we open the container's tag
        $output = $this->_container_open;
        if (sizeof($this->_breadcrumb) > 0) {
            foreach ($this->_breadcrumb as $key => $crumb) {
                // we put the crumb with open and closing tags
                $output .= $this->_crumb_open;
                if (strlen($crumb['href']) > 0) {
                    $output .= anchor($crumb['href'], $crumb['title']);
                } else {
                    $output .= $crumb['title'];
                }
                $output .= $this->_crumb_close;
                // we end the crumb with the divider if is not the last crumb
                if ($key < (sizeof($this->_breadcrumb) - 1)) {
                    $output .= $this->_divider;
                }
            }
        }
        // we close the container's tag
        $output .= $this->_container_close;
        return $output;
    }

}

/*class BreadcrumbComponent {
	private $breadcrumbs = array();
	private $separator = '  >  ';
	private $start = '<div id="breadcrumb">';
	private $end = '</div>';

	public function __construct($params = array()){
		if (count($params) > 0){
			$this->initialize($params);
		}		
	}
	
	private function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->{'_' . $key})){
					$this->{'_' . $key} = $val;
				}
			}
		}
	}

	function add($title, $href){		
		if (!$title OR !$href) return;
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href);
	}
	
	function output(){

		if ($this->breadcrumbs) {
			
			$output = $this->start;

			foreach ($this->breadcrumbs as $key => $crumb) {
				if ($key){ 
					$output .= $this->separator;
				}

				if (end(array_keys($this->breadcrumbs)) == $key) {
					$output .= '<span>' . $crumb['title'] . '</span>';			
				} else {
					$output .= '<a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
				}
			}
		
			return $output . $this->end . PHP_EOL;
		}
		
		return '';
	}
        public function demo($title, $href) {
           //$this->breadcrumbs[] = array('title' => $title, 'href' => $href);
            return $title."/".$href;
        }

}*/