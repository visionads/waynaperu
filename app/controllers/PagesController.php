<?php

Class PagesController extends BaseController{

    public function listPages()
    {
    	$list_pages = DB::table('pages')
		            ->join('contents', 'pages.id', '=', 'contents.page_id')
		            ->join('languages', 'languages.id', '=', 'contents.lang_id')
		            ->select('pages.state', 'contents.id','contents.page_id','contents.title','contents.description', 'languages.name')
		            ->orderBy('contents.id', 'asc')
                    ->groupBy('contents.page_id')
		            ->get();
        return View::make('admin.list_pages', array('list_pages' => $list_pages));
    }
    public function addPage()
    {
        $languages = Language::all();
        return View::make('admin.add_page', array('languages' => $languages));
    }
     public function savePage()
    {

        $languages = Language::all();
        $page = new Page;
        $page->state = '1';
        if($page->save()){
        	$date = date('Y-m-d H:i:s');
	        foreach ($languages as  $language) {
	        	DB::table('contents')->insert(
	                    array(
	                        'page_id' => $page->id,
	                        'lang_id' => $language->id,
	                        'title' => Input::get('title')[$language->code],
	                        'description' => Input::get('description')[$language->code],
	                        'created_at'  => $date,
	                        'updated_at'  => $date
	                    )
	                );
	        }
    	}
        return Redirect::route('list_pages');
    }

    public function editPage($id)
    {
        $page_id = $id;
        
        $data = DB::table('pages')
                    ->join('contents', 'pages.id', '=', 'contents.page_id')
                    ->join('languages', 'languages.id', '=', 'contents.lang_id')
                    ->select('pages.state', 'contents.id','contents.page_id','contents.title','contents.description', 'languages.name')
                    ->where('pages.id', $page_id)
                    ->orderBy('contents.id', 'asc')
                    ->get();

        return View::make('admin.edit_page', array( 'content' => $data, 'page_id' => $page_id));
    }
     public function saveEditPage($id)
    {
        $contents    =  DB::table('contents')
                    
                    ->where('contents.page_id', $id)
                    ->orderBy('contents.id', 'asc')
                    ->get();
        
        foreach ($contents as $index => $content) {
           $page = Content::find($content->id);
            $page->title = Input::get('title')[$content->id];
            $page->description = Input::get('description')[$content->id];
            $page->save();
        }
        return Redirect::route('list_pages');
        
    }
    

    public function delete(){
        $page_id        = Input::get('primery_id');
        $page           = Page::find($page_id);

        if($page){
            $page->delete();
            return Redirect::to('admin/pages')->with('msg','Page removed successfully');
        }

    }

}