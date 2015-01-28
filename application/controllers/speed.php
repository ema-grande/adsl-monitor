<?php 

/**
* 
*/
class Speed extends Controller
{
	public $today;
	public $list;
	public $avg;
	public $control = "speed";
	public $section;
	
	/**
	 * 
	 */
	public function index()
	{
		$this->today = date( "Y-m-d", time() );
		$this->day($this->today);
	}

	/**
	 * 
	 */
	public function day($today='')
	{
		if ( $today == '' ) {
			$today = date( "Y-m-d", time() );
		}
		$this->today = $today;
		$this->list = $this->model->getSpeedDate($this->today);
		$this->avg = $this->model->getAvgSpeedDate($this->today);
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
		$this->list = $this->model->getSpeedAll();
		$this->avg = $this->model->getAvgSpeedDate("");
		$this->section = "all";
		
		// load views
		$this->render();
	}

	public function average($today='')
	{
		if ( $today == '' ) {
			$today = date( "Y-m-d", time() );
		}
		$this->today = $today;
		$this->avg = $this->model->getAvgSpeedDate($this->today);
		$this->section = "average";

		// load view
		$this->render('speed-avg.php');
	}

	private function render($content='speed-index.php')
	{
		// load views
		require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/nav-t.php';
		require APP . 'views/'.$content;
		require APP . 'views/_templates/nav-b.php';
		require APP . 'views/_templates/footer.php';
	}
}