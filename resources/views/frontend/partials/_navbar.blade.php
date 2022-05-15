<header id="main-header" class="header-main">
  <div class="container">
    <div class="row">
        <div class="col-sm-12">
          <nav class="navbar navbar-expand-lg navbar-light">
              <a class="navbar-brand" href="{{route('home')}}">
              <img class="img-fluid" src="{{asset('frontend/images/logo.png')}}" alt="img">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="menu-btn d-inline-block" id="menu-btn">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
              </span>
              <span class="ion-navicon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                    <li class="nav-item dropdown">
                      <a class="nav-link " href="{{route('home')}}" id="navbarDropdown">
                      Home
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Categories
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                        @isset($categories)
                          @foreach($categories as $category)
                            <a href="{{route('category-blogs', $category->slug)}}">{{$category->name}}</a>
                          @endforeach
                        @endisset
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown-3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Tags
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown-3">
                          @isset($tags)
                            @foreach($tags as $tag)
                              <a class="dropdown-item" href="{{route('tag-blogs', $tag->slug)}}">{{$tag->name}}</a>
                            @endforeach
                          @endisset
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user-login-form')}}" role="button" >
                      Login
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user-register-form')}}" role="button" >
                      Register
                      </a>
                    </li>
                   
                </ul>
              </div>
          </nav>
        </div>
    </div>
  </div>
</header>