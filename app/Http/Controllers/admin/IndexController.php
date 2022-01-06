<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Kreait\Firebase\Database;

class IndexController extends Controller
{
    /**
     * @var Database
     */
    private $database;
    /**
     * @var string
     */
    private $tablename;
    public function __construct(Database $database)
    {
        $this->middleware('auth');
        $this->database = $database;
        $this->tablename = 'menus';
    }

    public function index(){
        $menus = $this->database->getReference($this->tablename)->getValue();
//        return $menus;
        return view('admin.index',compact('menus'));
    }
}
