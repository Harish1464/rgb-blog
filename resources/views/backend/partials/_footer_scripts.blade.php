 <script src="{{asset('assets/js/core/libs.min.js')}}"></script>
    
  <!-- External Library Bundle Script -->
  <script src="{{asset('assets/js/core/external.min.js')}}"></script>
  
  <!-- Widgetchart Script -->
  <script src="{{asset('assets/js/charts/widgetcharts.js')}}"></script>
  
  <!-- mapchart Script -->
  <script src="{{asset('assets/js/charts/vectore-chart.js')}}"></script>
  <script src="{{asset('assets/js/charts/dashboard.js')}}" ></script>
  
  <!-- fslightbox Script -->
  <script src="{{asset('assets/js/plugins/fslightbox.js')}}"></script>
  
  <!-- Settings Script -->
  <script src="{{asset('assets/js/plugins/setting.js')}}"></script>

  <!-- Sweertalert -->
  <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>


  <!-- Slider-tab Script -->
  <script src="{{asset('assets/js/plugins/slider-tabs.js')}}"></script>
  
  <!-- Form Wizard Script -->
  <script src="{{asset('assets/js/plugins/form-wizard.js')}}"></script>
  
  <!-- AOS Animation Plugin-->
  <script src="{{asset('assets/vendor/aos/dist/aos.js')}}"></script>
  
  <!-- Toastr-->
  <script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
  

  <!-- App Script -->
  <script src="{{asset('assets/js/hope-ui.js')}}" defer></script>
  <script type="text/javascript">
    @if(Session::has('success'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true,
      }
            toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.warning("{{ session('warning') }}");
    @endif
</script>
@stack('scripts')