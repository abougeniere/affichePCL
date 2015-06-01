<?php namespace affichePCL\Http\Controllers;



use League\Csv\Reader;
use League\Csv\Writer;


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

        $data = $reader->fetchAll();
        //print_r ($data);
        $data=array(1,2,3);

        //$data = $reader->fetchAssoc();

        //\Debugbar::info(var_dump($data));
        //\Debugbar::error('Something is definitely going wrong.');
        //\Debugbar::error($reader);
        return view('welcome')->with('data', $data);
	}

}
