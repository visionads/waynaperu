<?php

Class LanguagesController extends BaseController{

    public function index(){
        $languages  = Language::all();
        //return $languages;
        return View::make('admin.languages')->with('languages',$languages);
    }

    public function add_language(){

        $form_url   = 'admin/save_language';
        return View::make('admin.add_language')->with('form_url', $form_url);

    }

    public function save_language(){
    	// return Input::all();

        $name     	= Input::get('name');
        $lang_code	= Input::get('code');

        $tableName 	= 'languages';	
        $fieldName 	= 'flag';

        if(Input::hasFile('flag')){

            $destinationPath 	= 'uploads/flags';
            $extension = Input::file('flag')->getClientOriginalExtension(); // getting image extension
            $languageFileName	= $this->generateRandomStringForImage($tableName,$fieldName);
            $languageFileName	= $languageFileName.'.'.$extension;
            Input::file('flag')->move($destinationPath, $languageFileName);

        }else{

            $languageFileName = '';
        }

        $language            =   new Language;
        $language->name      =   $name;
        $language->code      =   $lang_code;
        $language->flag      =   $languageFileName;


        $language->save();

        return Redirect::to('admin/languages')->with('msg','Language added successfully');
    }

    public function edit_language(){

        $language_id = Route::input('id');

        $language = Language::find($language_id);

        if(!$language){
               return Redirect::to('admin/languages');
        }
        $form_url   = 'admin/update_language';
        return View::make('admin.add_language')->with('language',$language)->with('form_url', $form_url);
    }

    public function update_language(){

        $language_id		= Input::get('id');
        $language   		= Language::find($language_id);
        $name       		= Input::get('name');
        $code        		= Input::get('code');

        $tableName 			= 'languages';
        $fieldName 			= 'flag';

        if(Input::hasFile('flag')){
            @unlink('uploads/flags/'.$language->flag);
            $destinationPath 	= 'uploads/flags';
            $extension = Input::file('flag')->getClientOriginalExtension(); // getting image extension
            $languageFileName 	= $this->generateRandomStringForImage($tableName,$fieldName);
            $languageFileName   = $languageFileName.'.'.$extension;
            Input::file('flag')->move($destinationPath, $languageFileName);

        }else{

            $languageFileName = $language->flag;
        }

        $language->name     	=   $name;
        $language->code	        =   $code;
        $language->flag     	=   $languageFileName;


        $language->save();

        return Redirect::to('admin/languages')->with('msg','Language updated successfully');
    }

    public function delete_language(){

        $language_id 	= Input::get('primery_id');
        $language 		= Language::find($language_id);

        if($language){
            $language->delete();
            @unlink('uploads/flags/'.$language->flag);
            return Redirect::to('admin/languages')->with('msg','Language removed successfully');;
        }

    }

    public function en_language(){
        
        $url = app_path().'/lang/en/text.php';
        
        $lang_data = file_get_contents($url);
        $action = 'admin/language-file-en-save';
        
        return View::make('admin.language_editor')->with('lang_data',$lang_data)->with('action',$action);
        
    }
    
    public function en_language_save(){
        
        $url = app_path().'/lang/en/text.php';
        $file = Input::get('language');
        file_put_contents($url,$file);
        
        $lang_data = file_get_contents($url);
        $action = 'admin/language-file-en-save';
        
        return View::make('admin.language_editor')->with('lang_data',$lang_data)->with('action',$action);
    }
    
    
    
    public function fr_language(){
        
        $url = app_path().'/lang/fr/text.php';
        
        $lang_data = file_get_contents($url);
        $action = 'admin/language-file-fr-save';
        
        return View::make('admin.language_editor')->with('lang_data',$lang_data)->with('action',$action);
        
    }
    
    public function fr_language_save(){
        
        $url = app_path().'/lang/fr/text.php';
        $file = Input::get('language');
        file_put_contents($url,$file);
        
        $lang_data = file_get_contents($url);
        $action = 'admin/language-file-fr-save';
        
        return View::make('admin.language_editor')->with('lang_data',$lang_data)->with('action',$action);
    }

    public function es_language(){
        
        $url = app_path().'/lang/es/text.php';
        
        $lang_data = file_get_contents($url);
        $action = 'admin/language-file-es-save';
        
        return View::make('admin.language_editor')->with('lang_data',$lang_data)->with('action',$action);
        
    }
    
    public function es_language_save(){
        
        $url = app_path().'/lang/es/text.php';
        $file = Input::get('language');
        file_put_contents($url,$file);
        
        $lang_data = file_get_contents($url);
        $action = 'admin/language-file-es-save';
        
        return View::make('admin.language_editor')->with('lang_data',$lang_data)->with('action',$action);
    }

}