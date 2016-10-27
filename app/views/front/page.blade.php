@extends('front.layout')
@extends('front.header')
@extends('front.sidebar')
@extends('front.footer')
@section('content')
	<!-- Page Content -->
     <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="page_paggination">
               <div class="row">
                   <div class="col-md-12">
                        <ol class="breadcrumb">
                           <li><a href="{{ route('home') }}">{{ trans('text.home') }}</a></li>
                           <li><a href="{{ route('terms_n_conditions') }}">{{ isset($content->title) ? $content->title : null }}</a></li>
                        </ol>
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-12">
                    <div class="page_title">
                        <span>{{ isset($content->title) ? $content->title : null }}</span>
                    </div>
               </div>
           </div>

           <div class="collapse_wrapper">
              <div class="row">
                 <div class="col-lg-12">
                  <div class="pag-content">
                    {{ isset($content->description) ? $content->description : null }}
                  </div>    
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!-- /#page-content-wrapper -->
@stop