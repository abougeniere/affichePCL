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
        //dd($reader);
/*
        foreach ($reader as $index => $row) {
        echo ($row[0] ."<br>");

            //do something meaningfull here with $row !!
            //$row is an array where each item represent a CSV data cell
            //$index is the CSV row index
        }
        /*
//the $reader object will use the 'r+' open mode as no `open_mode` parameter was supplied.
       // $writer = Writer::createFromPath(new SplFileObject('/path/to/your/csv/file.csv', 'a+'), 'w');
//the $writer object open mode will be 'w'!!

		return view('welcome');
        //return View::make('hello', array('theLocation' =>  'NYC', 'theWeather'=> 'stormy', 'theColors' => $theColors));
        */
        //return View::make('welcome', array('datas' => $reader->getDelimiter()));
        $test ="ça marche!";

        //return view('welcome', ['name' => $test]);



        $data = $reader
            ->addFilter(function ($row) {
                return "97812014M4S"!= $row[0]; //we are looking for the year 2010
            })
            ->setLimit(20) //we just want the first 20 results
            ->fetchAll();
        //->toHTML('table-csv-data with-header');
        //dd($data);

        $headers = $reader->fetchOne();
        //dd($headers);

        $dataset = DataSet::source($data)->paginate(10)->getSet();
        //dd($dataset);

        //var_dump($dataset);
        //return view('welcome',$dataset);

        $grid = DataGrid::source($data)->getSet();



        //$grid = DataGrid::source($data);
        //dd($grid);

$i=array(1,2,3);
        return view('welcome',compact('grid'));
        //return view('welcome',$grid);

	}

}
