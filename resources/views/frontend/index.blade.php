@extends('frontend.layouts.main_layout')
@section('title') | Home @endsection
@section('main-content')

	  <!-- Breadcrumb Start -->
      <div class=" main-bg" >
         <div class="container-fluid p-0">
            <div class="text-left iq-breadcrumb-one
               iq-bg-over black     ">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                           <h2 class="title">
                              Three Column Blog                       
                           </h2>
                           <ol class="breadcrumb main-bg">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home mr-2"></i>Home</a></li>
                              <li class="breadcrumb-item active">Three Column Blog</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('frontend.partials._message')
      <!-- Breadcrumb End -->
      <!-- Blog Start -->
      <section class="iq-blog-section iq-pb-55">
         <div class="container">
            <div class="row">
               <div class="iq-blog text-left ">
                  <div class="row">
                  	@isset($blogs)
	                  	@foreach($blogs as $blog)

	                     <div class="col-lg-4 col-md-6">
	                        <div class="iq-blog-box">
	                           <div class="iq-blog-image clearfix">
	                              <img src="{{asset('storage/blog/'.@$blog->images[0]->path)}}" alt="Blog Image" loading="lazy">
	                           </div>
	                           <div class="iq-blog-detail">
	                              <div class="blog-title">
	                                 <a href="blog-details.html">
	                                    <h4 class="mb-3">{{$blog->name}}</h4>
	                                 </a>
	                              </div>
	                              <p class="iq-desc">{!! Str::limit($blog->description, 50) !!}</p>
	                              <div class="blog-footer">
	                                 <div class="iq-blog-meta">
	                                    <ul class="iq-postdate">
	                                       <li class="list-inline-item">
	                                          <i class="fa fa-calendar mr-1" aria-hidden="true"></i> <a href="#">{{$blog->created_at->format('Y-m-d')}}</a>
	                                       </li>
	                                    </ul>
	                                 </div>
	                                 <div class="blog-button">
	                                    <a class="iq-link-button" href="blog-details.html">Read More</a>
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                    @endforeach
	                @endisset
               </div>
            </div>
                        <div class="row">
               <div class="col-lg-12 text-center">
                  <ul class="page-numbers">
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="#">2</a></li>
                        <li><a class="next page-numbers" href="#">Next page</a></li>
                     </ul>
               </div>
            </div>
         </div>
      </section>

@endsection