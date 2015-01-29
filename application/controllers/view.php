<?php 

/**
* 
*/
class view extends Controller
{
	private $list;
	private $avg;
	private $view;
	private $date;

	public function index()
	{
		$this->speed();
	}

	public function speed($year='', $month='', $day='')
	{
		$this->view = "speed";
		if ( $year == '' ) {
			$this->format = "Y-m-d";
			$this->speedDate();
			return;
		}

		if ( $month == '') {
			$this->format = "Y";
			$this->speedDate( $year );
			return;
		}

		if ( $day == '') {
			$this->format = "Y-m";
			$this->speedDate( $year."-".$month );
			return;
		}

		if ( $day != '') {
			$this->format = "Y-m-d";
			$this->speedDate( $year."-".$month."-".$day );
			return;
		}
	}

	private function speedDate($date='')
	{
		
		if ( $date == '' ) {
			$date = date( $this->format, time() );
		}
		$this->date = $date;
		$this->list = $this->model->getSpeedDate($this->date);
		$this->avg = $this->model->getAvgSpeedDate($this->date);
		
		// load views
		$this->render("speed-index.php");
	}

	private function render($content='index.php')
	{
		// load views
		require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/nav.php';
		require APP . 'views/'.$content;
		require APP . 'views/_templates/nav.php';
		require APP . 'views/_templates/footer.php';
	}
}