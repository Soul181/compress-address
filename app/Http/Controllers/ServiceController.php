<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ServiceController extends Controller
{
	public function get_all_quantity()
    {
        $all = DB::table('links')->select('*')->get();
        $all_quantity = $all->count();
        return $all_quantity;
    }
	
	public function insert($link)
    {
		return DB::table('links')->insert([
			'url' => $link['url'],
			'path' => $link['path'],
			'created_at' =>NOW(),
		]);
    }
	
    public function validate_url($request) {
		$result = $this->validate($request, [
			'input_URL' => 'required|active_url',
		]);
		return $result['input_URL'];
	}
	
	public function validate_path($path) {
		$path = ['path' => $path];
		$rules = ['path' => 'regex:/^[a-z0-9]{6}$/'];
        $result = Validator::make($path, $rules)->passes();
		if ($result) {
			return $path['path'];
		}
	}
	
	public function validate_short($request) {
		$result = $this->validate($request, [
			'input_Short' => 'nullable|regex:/^[a-z0-9]{6}$/',
		]);
		return $result['input_Short'];
	}
	
	public function get_unique_random_path() {
		$alphabet = ['0','1','2','3','4','5','6','7','8','9','q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m'];
		$random_path = implode("",Arr::random($alphabet, 6));
		$check = $this->get_one($random_path);
		if($check != NULL){
			dd($check, $random_path);
			$this->get_unique_random_path();
		}
		return $random_path;
	}
	
	public function get_one($path) {
		$one = DB::table('links')->select('*')->where('path', $path)->first();
		return $one;
	}
}
