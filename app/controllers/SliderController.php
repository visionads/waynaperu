<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 9/22/16
 * Time: 12:23 PM
 */
class SliderController extends BaseController
{
    public function index()
    {
        $data['sliders']=Slider::all();
        return View::make('admin.slider.list_slider',$data);
    }
    public function create()
    {
        return View::make('admin.slider.add_slide');
    }
    public function store()
    {
        $data=Input::only('caption','status','sequence');
        $file=Input::file('path');
        $name = time().'-'.$file->getClientOriginalName();
        $file = $file->move('images/slider/', $name);
        $data['path'] = 'images/slider/'.$name;
        $slider= new Slider($data);
        $slider->save();
        Session::flash('message','Slider Image uploaded successfully.');
        return Redirect::to('admin/slider');
    }
    public function edit($id)
    {
        $data['slide']=Slider::find($id);
        return View::make('admin.slider.edit_slide',$data);
    }
    public function update()
    {
        $id=Input::get('id');
        $data=Input::only('caption','status','sequence');
        $slider= Slider::find($id);
        $slider->caption=$data['caption'];
        $slider->sequence=$data['sequence'];
        $slider->status=$data['status'];
        $slider->save();
        Session::flash('message','Slider information updated successfully.');
        return Redirect::to('admin/slider');
    }
    public function change_status($status,$id)
    {
        $slider= Slider::find($id);
        $slider->status=$status;
        $slider->save();
        Session::flash('message','Slide status changed successfully.');
        return Redirect::to('admin/slider');
    }
    public function destroy($id)
    {

        $slider= Slider::find($id);
        unlink(public_path($slider->path));
        $slider->delete();
        Session::flash('message','Slide has been deleted successfully.');
        return Redirect::to('admin/slider');
    }
}