<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use App\Exception;


class MainController extends Controller
{
	private $service;

	public function __construct(ServiceController $ServiceController)
    {
    $this->service = $ServiceController;
    }
	
    public function index() {
		//return view('welcome');
		return view('welcome', ['results' => NULL]);
	}
	
	public function redirect_to($path) {
		
	dd('here');
			$valid_path = $this->service->validate_path($path);
			$url_address = $this->service->get_one($valid_path);
			if($valid_path == NULL OR $url_address == NULL) {
				return redirect()->away("/");
			} else {
				return redirect()->away($url_address->url);
				}
		
        
		
		
		
			
			
			
	}
	
	public function store(Request $request) {
		// вывести возможные ошибки если есть - остановка выполнения
		//dd($request);
		$valid_url = $this->service->validate_url($request);
		$valid_path = $this->service->validate_short($request);
		if ($valid_path == NULL) {
			$valid_path = $this->service->get_unique_random_path();
		}
		$link = ['url'=> $valid_url,
				'path'=> $valid_path,
		];
		$one = $this->service->get_one($valid_path);
		if ($one != NULL){
			return view('welcome', ['results' => 'Такой уже занят']);
			//return $errors;
		} else {
			$insert = $this->service->insert($link);
		}
		
		
		//произвести запись в ЛОГ
		//вывести результат на welcome URL, Short, количество доступных записей в БД, через сколько удалиться запись из БД
		$results = $this->service->get_one($valid_path);
		$count = $this->service->get_all_quantity();
		//dd($results->url);
		return view('welcome', compact('results'));
		//return redirect()->away("/");
	}
}
