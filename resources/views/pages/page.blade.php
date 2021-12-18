@extends($layout)
@section('content')
<section class="site-content">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span
                        itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">{{$page->title??
                 ''}}</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- page-banner-section -->
      <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">{{$page->title??''}}</h1>
          </div>
            <div class="content-area">          
                <div class="content-section">
                {!! $page->description??'' !!}
                @if(isset($page->ftype))
                @if($page->ftype=='youtube' || $page->ftype=='vemeo')
                <iframe src="{{$page->video_link}}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen="" width="100%" height="400" frameborder="0"></iframe>
                @else
                {{-- <img src="{{$page->image_url}}" alt="{{$page->title}}"> --}}
                @endif
                @endif
                
              </div>
                 
            </div>
            <!--content-area-->         
        </div>
        <!--container-->
      </div>     
      <!--content-wrapper-->
    </section>

@endsection