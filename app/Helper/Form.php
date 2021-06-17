<?php

namespace App\Helper;

class Form{
    public static function renderForm($arrayItems, $singleRecord){
        $htmlOption = "";

        foreach ($arrayItems as $key => $item){
            $data["item"] = $item;
            $data["old_record"] = $singleRecord;
            switch ($item["type"]){
                case "text":
                    $htmlOption .= view("admin.template.form.input_text")->with($data)->render();
                    break;
                case "file":
                    $htmlOption .= view("admin.template.form.input_file")->with($data)->render();
                    break;
                case "checkbox":
                    $htmlOption .= view("admin.template.form.checkbox")->with($data)->render();
                    break;
                case "slug":
                    $htmlOption .= view("admin.template.form.slug")->with($data)->render();
                    break;
                case "textarea":
                    $htmlOption .= view("admin.template.form.textarea")->with($data)->render();
                    break;
                case "ckeditor":
                    $htmlOption .= view("admin.template.form.ckeditor")->with($data)->render();
                    break;
                case "select" :
                    $htmlOption .= view("admin.template.form.select")->with($data)->render();
                    break;
                case "multipleSelect" :
                    $htmlOption .= view("admin.template.form.multipleSelect")->with($data)->render();
                    break;
                case "email":
                    $htmlOption .= view("admin.template.form.email")->with($data)->render();
                    break;
                case "password":
                    $htmlOption .= view("admin.template.form.password")->with($data)->render();
                    break;
                case "multipleFile":
                    $htmlOption .= view("admin.template.form.multipleFile")->with($data)->render();
                    break;
            }
        }
            //htmlOption được trả về dưới dạng 1 string
            return $htmlOption;
    }
}
