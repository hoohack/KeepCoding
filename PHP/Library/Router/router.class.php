<?php
	/*
	  *@filename:router.class.php
	  *@author:hhq
	  *@description:This class implement forward the uri that the user request,then the system load the controller and method to run the system.
	  *classname:Router
	 */

	class Router {
		  /**
		     *
		     * uri
		     * the uri that the user request
		  */
		var $uri;

		/**
		  *
		  * routes
		  * the route array that include all 
		  * the route rule the user had set
		 */
		var $routes;

		/**
		  * class
		  * the name of the controller or the class
		 */
		var $class;

		/**
		  *
		  * method name
		  * the method name of the controller
		 */
		var $method;

		/**
		 *
		 * default_controller
		 * if the class can not load the correspond 
		 * controller and method
		 * the it will load this controller default
		  */
		var $default_controller;
		
		/**
		   * construct function
		   * initialize some param of the class
		 */
		function __construct() {
			//assign a value to the param
			include('../URI/uci.class.php');
			$this->uri = new URI();
			echo "begin";
		}

		/**
		 *
		 * This function determines what should be served based 
		 * on the URI request,
		 * as well as any "routes" that have been set in the 
		 * routing config file.
		 *
		 */
		function set_routing() {
			// Load the routes.php file.
			include('routes.php');

			//assign a value to the routes array and free it
			$this->routes = ((! isset($routes)) OR (! isset($routes)) ? array() : $routes;

			unset($routes);

			//assign for the default_controller
			$this->default_controller = (! isset($this->routes['default_controller']) OR $this->routes['default_contrller'] == '') ? FALSE : $this-> routes['default_controller'];

			//analysis the request uri
			$this->uri->fetchUriString();

			//if the request uri is a null value
			if($this->uri->uri_string == '') {
				// return the default controller	
				return $this->set_default_controller();
			//end if
			}

			//explode the request uri
			$this->uri->explode_uri();

			//Parse any custom routing that may exist 
			$this->parse_routes();
		}

		/**
		  *
		  *Set the default controller
		  *
		  **/
		function set_default_controller() {
			//Set the default controller
			$this->segments[0] = $this->routes['default_controller'];
			$this->segments[1] = 'index';
			$this->set_class($this->segments[0]);
			
			//set the default method
			$this-set_method('index');

			//assign to the route_segments
			$this->uri->route_segments = $this->segments;
		}

		/**
		  * This function matches any routes that may exist in
		  * the config/routes.php file against the URI to
		  * determine if the class/method need to be remapped.
		  **/
		function parse_routes() {
			//Turn the segment array into a URI string
			$uri = implode('/', $this->uri->segments);

			//if there a literal match?
			if(isset($this->routes[$uri])) {
				//if so, return the literal array
				$route_segments = explode('/', $this->routes[$uri]);
				$return $this->set_request($route_segments);
			//end if
			}else {
				//else	set request with the rouge segment
				$route_segments = explode('/', $uri);
				return $this-->set_request($route_setments);
			//end else
			}
		}

		/**
		  * Set the Route
		  *
		  * This function takes an array of URI segments as
		  * input, and sets the current class/method
		  *
		 **/
		function set_request() {
			//if segments is null
			if(count($segments) == 0) {
				//return the default controller
				return $this->set_default_controller();
			}//end if

			//set the controller
			$this->set_class($segments[0]);

			//if request include method name
			if(isset($segments[1]) {
				//set the method
				$this->set_method($segments[1]);
			}//end if
			else {//else
				//assign the method name with 'index'
				$this->method = 'index';
			}
			
			//assign the route segments
			$this->uri->route_segments = $segments;
		}

		/**
		  * Set the class name
		  *
		*/
		function set_class($class) {
			$this->class = str_replace(array('/', '.'), '', $class);
		}

		/**
		  *Fetch the current class
		  *
		 */
		function fetch_class() {
			return $this->class;
		}

		/**
		  *Set the method name
		  *
		  */
		function set_method($method) {
			$this->method = $method;
		}

		/**
		  *Fetch the current method
		  *
		  */
		function fetch_method() {
			return $this->method;
		}
	}
//END Router Class

/* End of file router.class.php */
