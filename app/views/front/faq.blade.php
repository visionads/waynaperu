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
                           <li><a href="{{ route('faq_front') }}">{{ trans('text.faq_title') }}</a></li>
                        </ol>
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-12">
                    <div class="page_title">
                        <span>{{ trans('text.faq_title_main') }}</span>
                    </div>
               </div>
           </div>

           <div class="collapse_wrapper">
              <div class="row">
                 <div class="col-lg-12">
                  <div class="faq-content">
                    <h6>{{ trans('text.general_questions') }}</h6>
                    <div class="accordion-group">
                      
                              <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree1">
                                       {{ getFaqQue(1) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree1" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                        {{ getFaqAns(1) }}
                                    
                                   </div>
                                </div>

                          </div>
                          <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree2">
                                       {{ getFaqQue(2) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree2" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(2) }}
                                    
                                   </div>
                                </div>
                      </div>


                    <h6>{{ trans('text.validity_voucher') }}</h6>
                    <div class="accordion-group">
                      
                              <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree4">
                                       {{ getFaqQue(4) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree4" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                        {{ getFaqAns(4) }}
                                    
                                   </div>
                                </div>

                          </div>
                          <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree5">
                                       {{ getFaqQue(5) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree5" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(5) }}
                                    
                                   </div>
                                </div>
                      </div>


                      <h6>{{ trans('text.purchasing_ordering') }}</h6>
                    <div class="accordion-group">
                      
                              <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree6">
                                       {{ getFaqQue(6) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree6" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                        {{ getFaqAns(6) }}
                                    
                                   </div>
                                </div>

                          </div>
                          <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree7">
                                       {{ getFaqQue(7) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree7" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(7) }}
                                    
                                   </div>
                                </div>
                      </div>
                      <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree8">
                                       {{ getFaqQue(8) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree8" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(8) }}
                                    
                                   </div>
                                </div>
                      </div>


                      <h6>{{ trans('text.package_delivary') }}</h6>
                    <div class="accordion-group">
                      
                              <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree9">
                                       {{ getFaqQue(9) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree9" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                        {{ getFaqAns(9) }}
                                    
                                   </div>
                                </div>

                          </div>
                          <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree11">
                                       {{ getFaqQue(11) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree11" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(11) }}
                                    
                                   </div>
                                </div>
                      </div>


                      <h6>{{ trans('text.appointment_partcipition') }}</h6>
                    <div class="accordion-group">
                      
                              <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree12">
                                       {{ getFaqQue(12) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree12" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                        {{ getFaqAns(12) }}
                                    
                                   </div>
                                </div>

                          </div>
                          <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree13">
                                       {{ getFaqQue(13) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree13" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(13) }}
                                    
                                   </div>
                                </div>
                      </div>

                      <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree14">
                                       {{ getFaqQue(14) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree14" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(14) }}
                                    
                                   </div>
                                </div>
                      </div>
                      <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree15">
                                       {{ getFaqQue(15) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree15" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(15) }}
                                    
                                   </div>
                                </div>
                      </div>
                      <div class="accordion-group">
                                 <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree16">
                                       {{ getFaqQue(16) }} <span class="arrow1"></span> </a>
                               </div>
                               <div id="collapsethree16" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner inner_content">
                                      <!-- Experince Faq -->
                                    
                                       {{ getFaqAns(16) }}
                                    
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