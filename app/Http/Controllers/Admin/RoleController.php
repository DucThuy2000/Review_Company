<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Functions;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Role as MainModel;
use Session;

class RoleController extends AdminController
{
    protected $pathView = "admin.page.role.";

    protected $resize = [
        'thumbnail' => ['width' => 100],
        'standard' => ['width' => 100],
    ];

    protected $fieldForm = [
        'general_tab' => [
            'tab' => 'General (VI)',
            'items' => [
                ['label' => 'Role Name', 'name' => 'name', 'type' => 'text'],
            ]
        ]
    ];

    protected $fieldList = [
        ['label' => 'iD', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Role Name', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Created At', 'name' => 'created_at', 'type' => 'dateFormat'],
        ['label' => 'Updated At', 'name' => 'updated_at', 'type' => 'dateFormat']
    ];

    protected $removeRedundant = ['_token'];
    public function __construct(){
        //Get name of Controller
        $getControllerName = (new \ReflectionClass($this))->getShortName();
        $shortController = Functions::replaceName($getControllerName);
        $this -> folderUpload = $shortController;
        $this -> controllerName = $shortController;
        view()->share("shortController", $shortController);
        view()->share("controllerName",$this -> controllerName);
        view()->share("folderUpload", $this -> folderUpload);
        view()->share("fieldForm", $this -> fieldForm);
        view()->share("fieldList", $this -> fieldList);
        $this -> model = new MainModel();
    }

    public function store(Request $request){
        $this -> validateForm($request);

        $data = $this -> getDataRole($request -> all());
        $strAction = [];
        foreach ($data as $key => $value){
            if(is_array($value))
            {
                //dd($value);
                foreach ($value as $model => $actions){
                    foreach ($actions as $action => $on){
                        if($on == "on"){
                            $strAction[$model . "." . $action] = true;
                        }
                        else{
                            $strAction[$model . "." . $action] = false;
                        }
                    }
                }
                $value = json_encode($strAction);
            }
            $this -> model -> $key = $value;
        }

        $this -> model -> save();

        Session::flash("action_success","Thêm mới role thành công");
        return redirect() -> route("admin." . $this -> controllerName . ".index");
    }

    public function update(Request $request, $id){
        $record = $this -> model -> find($id);
        $this -> validateForm($request);

        $data = $this -> getDataRole($request -> all());
        $strAction = [];
        foreach ($data as $key => $value){
            if(is_array($value))
            {
                //dd($value);
                foreach ($value as $model => $actions){
                    foreach ($actions as $action => $on){
                        if($on == "on"){
                            $strAction[$model . "." . $action] = true;
                        }
                        else{
                            $strAction[$model . "." . $action] = false;
                        }
                    }
                }
                $value = json_encode($strAction);
            }
            $record -> $key = $value;
        }

        $record -> save();

        Session::flash("action_success","Sửa mới role thành công");
        return redirect() -> route("admin." . $this -> controllerName . ".index");
    }

    public function getDataRole($request){
        if($request['_token']) {
            unset($request['_token']);
        }
        return $request;
    }
}
