<?php namespace affichePCL\Http\Controllers;





use Illuminate\Support\Facades\View;
use League\Csv\Reader;
use League\Csv\Writer;
use Zofe\Rapyd\Facades\DataSet;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataForm;
use Zofe\Rapyd\Facades\DataEdit;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
    /*
	public function __construct()
	{
		$this->middleware('guest');
	}
*/
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
    {
        echo getcwd() . "\n";


        $reader = Reader::createFromPath('../uploads/pcl.csv');

        $reader->setDelimiter(";");

        $data = $reader->fetchAll();

        //->toHTML('table-csv-data with-header');
        //dd($data);

        $headers = $reader->fetchOne();
        //dd($headers);

        $dataset = DataSet::source($data)->paginate(10)->getSet();
        //dd($dataset);

        $grid = DataGrid::source($dataset);
        //dd($grid);

        //return view('welcome')->with('grid', $grid);
        //return view('welcome', ['dataset' => $dataset]);
        return view('welcome')->with('dataset', $dataset);

	}

}
