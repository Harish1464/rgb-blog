@extends('backend.layouts.main_layout')
@section('title') Blog Form @endsection
@section('main-content')
    <div class="iq-navbar-header" style="height: 215px;">
      <div class="container-fluid iq-container">
          <div class="row">
              <div class="col-md-12">
                  <div class="flex-wrap d-flex justify-content-between align-items-center">
                      <div>
                          <h1>Create Blog</h1>
                          <p>Create new blogs here.</p>
                      </div>
                      <div>
                        <a href="" class="btn btn-link btn-soft-light">
                            <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z" fill="currentColor"></path>                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07996 6.6499V6.6599C7.64896 6.6599 7.29996 7.0099 7.29996 7.4399C7.29996 7.8699 7.64896 8.2199 8.07996 8.2199H11.069C11.5 8.2199 11.85 7.8699 11.85 7.4289C11.85 6.9999 11.5 6.6499 11.069 6.6499H8.07996ZM15.92 12.7399H8.07996C7.64896 12.7399 7.29996 12.3899 7.29996 11.9599C7.29996 11.5299 7.64896 11.1789 8.07996 11.1789H15.92C16.35 11.1789 16.7 11.5299 16.7 11.9599C16.7 12.3899 16.35 12.7399 15.92 12.7399ZM15.92 17.3099H8.07996C7.77996 17.3499 7.48996 17.1999 7.32996 16.9499C7.16996 16.6899 7.16996 16.3599 7.32996 16.1099C7.48996 15.8499 7.77996 15.7099 8.07996 15.7399H15.92C16.319 15.7799 16.62 16.1199 16.62 16.5299C16.62 16.9289 16.319 17.2699 15.92 17.3099Z" fill="currentColor"></path>
                            </svg>                            
                              Blog Form
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="iq-header-img">
          <img src="{{asset('assets/images/dashboard/top-header.png')}}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
          <img src="{{asset('assets/images/dashboard/top-header1.png')}}" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
          <img src="{{asset('assets/images/dashboard/top-header2.png')}}" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
          <img src="{{asset('assets/images/dashboard/top-header3.png')}}" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
          <img src="{{asset('assets/images/dashboard/top-header4.png')}}" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
          <img src="{{asset('assets/images/dashboard/top-header5.png')}}" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
      </div>
    </div>          
    <!-- Nav Header Component End -->
        
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end">
                        <a href="{{route('blog.index')}}" class="btn btn-primary">
                            <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                            </svg>                                                      
                            Back To Blog List
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="post" action="{{isset($blog)?route('blog.update', $blog->slug): route('blog.store')}}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::guard('admin')->user()->id}}">
                            <div class="col-md-6">
                               <label for="name" class="form-label">Name of Blog</label>
                               <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Blog name here.." value="{{isset($blog)? $blog->name: old('name')}}" required>
                               <div class="valid-feedback">
                                  Looks good!
                               </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                               <label for="name" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option>Select Status</option>
                                    <option value="1"  {{ @$blog->status == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ @$blog->status == 0 ? 'selected' : '' }}>Un-publish</option>
                                </select> 
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                               <label for="name" class="form-label">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option>Select Category</option>
                                    @forelse($categories as $category)
                                        <option value="{{$category->id}}"  {{ @$blog->blogCategory[0]->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @empty

                                    @endforelse
                                </select> 
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                           <div class="col-md-6">
                               <label for="name" class="form-label">Tag</label>
                                <select class="form-control @error('tag_id') is-invalid @enderror" id="tag_id" name="tag_id" required>
                                    <option>Select Tag</option>
                                    @forelse($tags as $tag)
                                        <option value="{{$tag->id}}"  {{ @$blog->blogTag[0]->tag_id == $tag->id ? 'selected' : '' }}>{{$tag->name}}</option>
                                    @empty

                                    @endforelse
                                </select> 
                                @error('tag_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                               <label for="name" class="form-label">Status</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"name="description" id="editor" placeholder="Enter description" required> {{isset($blog)? $blog->description: old('description')}}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label class="col-lg-1 col-form-label" for="image">Image</label>
                                    <div class="col-lg-3">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" id="image" accept="image/*" alt="Image" loading="lazy">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2">
                                        <img src="{{isset($blog)? asset('images/blog/'.$blog->image) : asset('storage/no-image.jpg') }}" id="preview-image" alt="Image" loading="lazy" style="border: 1px solid #eaeaea; width:50px; height: 50px;">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-6"><br>
                               <button class="btn btn-primary" type="submit">{{isset($blog)?'Update': 'Submit'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    editor.ui.view.editable.element.style.height = '200px';
                } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
           $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-image').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
           });
        });
    </script>
@endpush


      