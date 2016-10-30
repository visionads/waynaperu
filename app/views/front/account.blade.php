@extends('front.layout')
@extends('front.header')
@extends('front.sidebar')
@extends('front.footer')
@section('content')

<!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <div class="tab_wrapper">    
              	 <div class="page_paggination">
                   <div class="row">
                       <div class="col-md-12">
                            <ol class="breadcrumb">
                               <li><a href="{{ route('home') }}" title="Home">{{trans('text.home')}}</a></li>
                               <li class="active">{{trans('text.profile')}}</li>
                            </ol>
                       </div>
                   </div>
               </div>
                     
                  <h3 class="title_1">{{ trans('text.your_profile') }}</h3> 
                  <h4 class="title2">{{ trans('text.welcome_text') }}, 
                    @if(Auth::user()->first_name != '' || Auth::user()->last_name != '')
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    @else
                    {{ Auth::user()->username }}
                    @endif
                    !</h4>
                  
                  <div class="tabs_inner_wrapper">
                       <div class="tab_row">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">{{ trans('text.per_info') }}</a></li>
                            <li><a data-toggle="tab" href="#menu1">{{ trans('text.payment_info') }}</a></li>
                          </ul>
                       </div>
                       
                       <div class="tab_content_main">
                      	<div class="row custom_bg">
                          <div class="col-md-12">
                          
                             <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    
                                    <!-- tab content -->
                                    <div class="row">

                                    	{{  Form::open(array('route' => 'save_account')) }}
                                        <div class="col-md-4 col-sm-4">
                                             <div class="form_inner_content">
                                                 <h5>{{ trans('text.your_profile') }}</h5>
                                                 <div class="form_row">
                                                        <input type="text" name="first_name" placeholder="{{ trans('text.first_name') }}" value="{{ Auth::user()->first_name }}" class="cart_form2int inputbtn1">
                                                        {{ $errors->first('first_name', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="text" name="last_name" placeholder="{{ trans('text.surname') }}" value="{{ Auth::user()->last_name }}" class="cart_form2int inputbtn1">
                                                        {{ $errors->first('last_name', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="email" name="email" placeholder="{{ trans('text.email') }}" value="{{ Auth::user()->email }}" class="cart_form2int inputbtn1" readonly>
                                                        {{ $errors->first('email', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="date" name="dob" placeholder="{{ trans('text.dob') }}" value="{{ Auth::user()->dob }}" class="datepicker cart_form2int inputbtn1">
                                                        {{ $errors->first('dob', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="text" name="passport" placeholder="{{trans('text.id_passport')}}" value="{{ Auth::user()->passport }}" class="cart_form2int inputbtn1">
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                             <div class="form_inner_content">
                                                 <h5>{{ trans('text.shipping_info') }}</h5>
                                                                                                 
                                                  <div class="form_row">
                                                        <input type="text" name="direction" placeholder="{{ trans('text.address') }}" value="{{ Auth::user()->direction }}" class="cart_form2int inputbtn1">
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="text" name="flat" placeholder="{{ trans('text.floor') }}" value="{{ Auth::user()->flat }}" class="cart_form2int inputbtn1">
                                                  </div>

                                                  <div class="form_row">
                                                        <input type="text" name="city" placeholder="{{ trans('text.city') }}" value="{{ Auth::user()->city }}" class="cart_form2int inputbtn1">
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="text" name="district" placeholder="{{ trans('text.district') }}" value="{{ Auth::user()->district }}" class="cart_form2int inputbtn1">
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="text"name="province"  placeholder="{{ trans('text.province') }}" value="{{ Auth::user()->province }}" class="cart_form2int inputbtn1">
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="text" name="department" placeholder="{{ trans('text.department') }}" value="{{ Auth::user()->dep }}" class="cart_form2int inputbtn1">
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                             <div class="form_inner_content">
                                                 <h5>{{ trans('text.change_pswd') }}</h5>
                                                 <div class="form_row">
                                                        <input type="password" name="old_pass" placeholder="{{ trans('text.current_pswd') }}" class="cart_form2int inputbtn1">
                                                        {{ $errors->first('old_pass', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="password" name="new_pass" placeholder="{{ trans('text.new_pswd') }}" class="cart_form2int inputbtn1">
                                                        {{ $errors->first('new_pass', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
                                                  <div class="form_row">
                                                        <input type="password" name="confirm_new_pass" placeholder="{{ trans('text.confirm_new_pswd') }}" class="cart_form2int inputbtn1">
                                                        {{ $errors->first('confirm_new_pass', '<p class="alert alert-danger">:message</p>') }}
                                                  </div>
												  <input type="submit" value="{{ trans('text.save_changes') }}" class="btn btn_login">
                                             </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                    <!-- tab content -->
                                    
                                  
                                </div>
                                
                                
                                <div id="menu1" class="tab-pane fade">
                                  
                                </div>
                              </div>
                             
                          </div>
                      </div>    
                       </div> 
                  </div>
                          
                          
                  </div>
                  
                  
               </div>
               
               
           
         </div>
         <!-- /#page-content-wrapper -->
@stop
