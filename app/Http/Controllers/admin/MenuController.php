<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use function Symfony\Component\Translation\t;

class MenuController extends Controller
{
    /**
     * @var Database
     */
    private $database;
    /**
     * @var string
     */
    private $tablename;
    /**
     * @var string
     */
    private $path;

    public function __construct(Database $database)
    {
        $this->middleware('auth');
        $this->database = $database;
        $this->tablename = 'menus';
        $this->path = 'uploads/menus/photo/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    public function index()
    {

        $menus = $this->database->getReference($this->tablename)->getValue();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'photo' => 'required'
        ]);
        if ($request->hasfile('photo')){
            $img = $request->photo;
            $photo = uniqid('m').'img.'.$img[0]->getClientOriginalExtension();
        }else{
            $photo = '';
        }
        $menu = [
            'name' => $request->name,
            'price' => $request->price,
            'phone' => $request->phone,
            'photo' => $photo,
        ];

        if ($request->hasFile('photo')){
            if (!file_exists($this->path)){
                mkdir($this->path,755,true);
            }
            $img[0]->move($this->path,$photo);
        }

        $menuRef = $this->database->getReference($this->tablename)->push($menu);

        if ($menuRef){
            return redirect('admin/menus')->with('status', 'Menu added successfully!');
        }else{
            return redirect('admin/menus')->with('status', 'Menu not added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    public function edit($id)
    {
        $menu = $this->database->getReference($this->tablename)->getChild($id)->getValue();
        if ($menu){
            return view('admin.menus.edit',compact('menu','id'));
        }else{
            return redirect()->back()->with('status','Menu ID not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'photo' => 'required'
        ]);
        $m = $this->database->getReference($this->tablename)->getChild($id)->getValue();
        if($m['photo'] == '' && $request->photo == '' && $request->old_photo == ''){
            $image = '';
        }
        if($m['photo'] != '' && $request->photo == '' && $request->old_photo != ''){
            $image = $m['photo'];
        }
        if($m['photo'] != '' && $request->photo == '' && $request->old_photo == ''){
            if (file_exists($this->path.$m['photo'])) {
                unlink($this->path.$m['photo']);
            }
            $image = '';
        }
        if ($m['photo'] != '' && $request->photo != '' && $request->old_photo == '') {
            if (file_exists($this->path.$m['photo'])) {
                unlink($this->path.$m['photo']);
            }
            $img = $request->photo[0];
            $image = uniqid('m').'img.'.$img->getClientOriginalExtension();
        }elseif($m['photo'] == '' && $request->photo != '' && $request->old_photo == ''){
            $img = $request->photo[0];
            $image = uniqid('m').'img.'.$img->getClientOriginalExtension();
        }
        $menu = [
            'name' => $request->name,
            'price' => $request->price,
            'phone' => $request->phone,
            'photo' => $image,
        ];
        $updated = $this->database->getReference($this->tablename.'/'.$id)->update($menu);
        if ($updated){
            if($request->hasfile('photo')){
                if (!file_exists($this->path)){
                    mkdir($this->path, 777,true);
                }
                $img->move($this->path,$image);
            }
            return redirect('admin/menus')->with('status','Menu updated successfully');
        }else{
            return redirect('admin/menus')->with('status','Menu fail to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    public function destroy($id)
    {
        $m = $this->database->getReference($this->tablename)->getChild($id)->getValue();
        if ($m['photo'] != '') {
            if (file_exists($this->path.$m['photo'])){
                unlink($this->path.$m['photo']);
            }
        }
        $deleted = $this->database->getReference($this->tablename.'/'.$id)->remove();
        if ($deleted){
            return redirect('admin/menus')->with('status','Menu deleted successfully');
        }else{
            return redirect('admin/menus')->with('status','Menu fail to delete');
        }
    }
}
