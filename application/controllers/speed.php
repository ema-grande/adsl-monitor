<?php 

/**
* 
*/
class Speed extends Controller
{
	private $today;
	private $list;
	private $avg;
	private $control = "speed";
	private $section;
	private $format;
	
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
		$this->format = "Y-m-d";
		if ( $today == '' ) {
			$today = date( $this->format, time() );
		}
		$this->today = $today;
		$this->list = $this->model->getSpeedDate($this->today);
		$this->avg = $this->model->getAvgSpeedDate($this->today);
		$this->section = "day";

		// load views
		$this->render();
	}

	public function month($today='')
	{
		$this->format = "Y-m";
		if ( $today == '' ) {
			$today = date( $this->format, time() );
		}
		$this->today = $today;
		$this->list = $this->model->getSpeedDate($this->today);
		$this->avg = $this->model->getAvgSpeedDate($this->today);
		$this->section = "month";

		// load views
		$this->render();
	}

	public function year($today='')
	{
		$this->format = "Y";
		if ( $today == '' ) {
			$today = date( $this->format, time() );
		}
		$this->today = $today;
		$this->list = $this->model->getSpeedDate($this->today);
		$this->avg = $this->model->getAvgSpeedDate($this->today);
		$this->section = "year";

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