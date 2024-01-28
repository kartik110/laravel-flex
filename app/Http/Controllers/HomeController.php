<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $changeClass = 1)
    {
        // dump($request->all());
        $inputArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $chosenClass = $request->class;
        $rotatedArray = $this->searchClass($inputArray, $chosenClass);
        return view('home', compact('rotatedArray'));
    }


    function searchClass($array, $chosenClass)
    {
        $index = array_search($chosenClass, $array);

        if ($index !== false) {
            $firstPart = array_slice($array, $index);
            $secondPart = array_slice($array, 0, $index);
            $rotatedArray = array_merge($firstPart, $secondPart);
            return $rotatedArray;
        }
        return $array;
    }

    public function changeClass(Request $request)
    {
        return redirect()->route('home', ['class' => $request->input('class')]);
    }


}
