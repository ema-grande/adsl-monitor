<?php 

/**
* 
*/
class Ping extends Controller
{
	private $today;
	private $list;
	private $control = "ping";
	private $section;
	private $format;

	/**
	 * 
	 */
	public function index()
	{
		$this->today = date( "Y-m-d", time() );
		$this->day($this->today);
		$this->section = "index";
	}

	/**
	 * 
	 */
	public function day($today='')
	{
		$this->format = "Y-m-d";
		if ( $today == '' ) {
			$today = date( $this->format, time() );
		}
		$this->today = $today;
		$this->list = $this->model->getPingDate($this->today);
		$this->section = "day";
		
		// load views
		$this->render();
	}

	/**
	 * 
	 */
	public function all()
	{
		$this->today = date( "Y-m-d", time() );
		$this->all = 1;
		$this->list = $this->model->getPingAll();
		$this->section = "all";
		
		// load views
		$this->render();
	}

	private function render()
	{
		// load views
		require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/nav.php';
		require APP . 'views/ping-index.php';
		require APP . 'views/_templates/nav.php';
		require APP . 'views/_templates/footer.php';
	}
}