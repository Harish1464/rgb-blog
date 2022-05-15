<!doctype html>
<html lang="en">
   @include('frontend.partials._header')
   <body>
      <!-- loading -->
      <div id="loading">
         <div id="loading-center">
            <div class="load-img" >
               <img src="{{asset('frontend/images/loader.gif')}}" alt="loader">
            </div>
         </div>
      </div>
      <!-- loading End -->
      <!-- Header -->
      @include('frontend.partials._navbar')
      <!-- Header End -->
      @yield('main-content')
      <!-- Footer Start -->
      @include('frontend.partials._footer')
      <!-- Footer End -->
      <!-- === back-to-top === -->
      <div id="back-to-top">
         <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
      </div>
      <!-- === back-to-top End === -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      @include('frontend.partials._footer_scripts')
      
   </body>
</html>