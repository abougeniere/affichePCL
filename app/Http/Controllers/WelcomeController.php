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

        // CSV object
        $reader = Reader::createFromPath('../uploads/pcl.csv');

        // CSV properties
        $reader->setDelimiter(";");

        // Get CSV header
        $headers = $reader->fetchOne();
        $reader->setOffset(1);

        // Get CSV datas
        $data = $reader->fetchAll();

        // new Dataset from CSV
        $dataset = DataSet::source($data)->paginate(10)->getSet();


        // new dataGrid from dataSet
        $grid = DataGrid::source($data);

        $index=0;
        foreach ($headers as $header) {
            $grid->add($index++,$header, true); //field name, label, sortable
        }

        // Datagrid properties
        $grid->paginate(10); //pagination
        $grid->attributes(array("class"=>"table table-striped table-hover"));

        // Show view
        return view('welcome')->with('dataset', $grid);

	}

}
