<?php 

/**
* 
*/
class Drop extends Controller
{
	public $today;
	public $list;
	public $control = "drop";
	/**
	 * 
	 */
	public function index()
	{
		$this->today = date( "Y-m-d", time() );
		$this->list = $this->model->getDropDate($this->today);

		// load views
		$this->render();
		
	}

	/**
	 * 
	 */
	public function day($today='')
	{
		$this->today = $today;
		$this->list = $this->model->getDropDate($this->today);
		
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
		$this->list = $this->model->getDropAll();
		
		// load views
		$this->render();
	}

	private function render()
	{
		// load views
		require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/nav-t.php';
		require APP . 'views/drop-index.php';
		require APP . 'views/_templates/nav-b.php';
		require APP . 'views/_templates/footer.php';
	}
}