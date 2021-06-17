<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;
use File;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $model;
    protected $pathView;
    protected $folderUpload;
    protected $resize;
    public function index(){
        $data = $this -> model -> paginate(10);
        return view($this -> pathView . "index",compact("data"));
    }

    public function create(){
        return view($this -> pathView . "form");
    }

    public function store(Request $request){
        //Gửi request sang hàm validateForm để xác thực
        $this -> validateForm($request);
        $data = $this -> getData($request -> all());
        //Gán các trường trong db bằng value
        if($data){
            foreach ($data as $key => $value){
                if( is_object($value) ){
                    $value = $this -> uploadImage($value);
                }
                $this -> model -> $key = $value;
            }
        }

        $this -> model -> save();

        // Xử lý với tags
        if( isset($request->tag_id)  && count($request->tag_id) > 0 ){
            $tag_id = $request->tag_id;
            $tags_id = [];
            foreach($tag_id as $k => $v){
                // Kiểm tra xem có phải là số hoặc chữ số hay không
                if(is_numeric ($v)){
                    $tags_id[] = $v;
                }
            }
            // attach(array);
            $this-> model -> tags() -> attach($tags_id);
        }

        Session::flash("action_success", "Thêm mới thành công");
        return redirect() -> route("admin." . $this -> controllerName . ".index");
    }

    public function update(Request $request, $id){
        $record = $this -> model -> find($id);

        $this -> validateForm($request);
        $data = $this -> getData($request -> all());

        foreach ($data as $key => $value){
            if(is_object($value)){
                $this -> deleteImage($record -> {$key});
                $value = $this->uploadImage($value);
            }
            $record[$key] = $value;
        }

        $record -> save();

        if(isset($request -> tag_id) && count($request -> tag_id) > 0)
        {
            $tag_id = $request -> tag_id;
            $tags_id = [];
            foreach ($tag_id as $key => $value){
                if(is_numeric($value)){
                    $tags_id[] = $value;
                }
            }

            $record -> tags() -> sync($tags_id);
        }

        Session::flash("action_success", "Sửa mới thành công");
        return redirect() -> route("admin." . $this -> controllerName . ".index");

    }

    public function edit($id){
        $singleRecord = $this -> model -> find($id);
        return view($this -> pathView . ".form", compact("singleRecord"));
    }

    public function delete($id){
        $record = $this -> model -> find($id);
        $record -> delete();
        if($record){
            return response() -> json([
                "code" => 200,
                "message" => "Delete success"
            ],200);
        }
        else{
            return response() -> json([
                "code" => 500,
                "message" => "Cant delete this record"
            ], 500);
        }
    }

    public function validateForm(Request $request){
        //Nhận request từ store và xác thực thằng name
        $request -> validate(
            [
                // Điều kiện bắt buộc
                'name' => 'bail|required|max:255'
            ], [
            // Ràng buộc điều kiện
            'required' => ':attribute không được đễ trống',
            'max:255' => ':attribute không được quá 255 kí tự'
        ], [
            // Translation
            'name' => 'Tên'
        ]);
    }

    /* Mục Đích
     * 1, Lấy được các value được fill ở Request mà trong $fieldForm của DB cũng có
     * 2, Trả về 1 mảng các phần tử được fill trong Form để thêm vào db
     * */
    public function getData($request){
        $data = [];

        $keyArray = [];

        foreach($request as $key => $value){
            $keyArray[] = $key;
        }

        foreach ($this -> fieldForm as $key => $value){
            $item = $value["items"];
            foreach ($item as $_key => $v){
                $name = $v["name"];
                if(in_array($name, $keyArray)){
                    $data[$name] = $request[$name];
                }
            }
        }

        return array_diff_key($data, array_flip($this->removeRedundant));
    }

    public function uploadImage($imgObject){
        //Lấy đuôi ảnh
        $typeFile = $imgObject -> getClientOriginalExtension();

        $sizeImage = $this -> resize;

        $randomFileName = Str::random(12) . '.' . $typeFile;

        //Tạo mới 1 resource
        $ImageResize = Image::make($imgObject);
        $ImageResize -> fit(300,300);
        $path = public_path() . '/picture/' . $this -> folderUpload . '/' ;

        //Tự động tạo path mới với filesystem (use File)
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true);
        }

        $ImageResize -> save($path.$randomFileName);

        if(count($sizeImage) > 0){
            foreach ($sizeImage as $key => $size){
                $resize_path = $path . $key . '/';
                if(!File::isDirectory($resize_path)){
                    File::makeDirectory($resize_path, 0777, true);
                }
                // resize(with, height, closure callback());
                $ImageResize -> resize($size['width'],null,function ($constraint){
                    $constraint->aspectRatio();
                });

                $ImageResize -> save($resize_path.$randomFileName);
            }
        }

        return $randomFileName;
    }

    public function deleteImage($imageName){
        $path = public_path() . "/picture/" . $this -> folderUpload . "/";

        $oldImage = $path.$imageName;

        $sizeImage = $this -> resize;

        if(isset($imageName) && file_exists($oldImage)){
            //Delete old imageName
            unlink($oldImage);
        }

        if(count($sizeImage) > 0){
            foreach ($sizeImage as $key => $size){
                $resize_path = $path . $key . '/' . $imageName;
                if(isset($imageName) && file_exists($resize_path) ){
                    unlink($resize_path);
                }
            }
        }
    }
}
