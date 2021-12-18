@extends($layout)
@section('content')

    <section class="site-content bg-gray">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span
                        itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">FAQs</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
      $faqs=array();
      if ($page->description) {
        $faqs=json_decode($page->description);
      }
      ?>
      <!-- page-banner-section -->
      <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">{{$page->title??
                 ''}}</h1>
          </div>
            <div class="content-area">
              <div class="content-section">
                <div class="faqpageaccordion" id="accordionfaq">
                  @if($faqs)
                  @foreach($faqs as $f=>$faq)
                  <div class="faq-card">
                    <div class="faq-header">
                      <button class="faq-button" type="button" data-toggle="collapse" data-target="#faq{{$f}}" aria-expanded="true">
                        {{$faq->title??''}}
                      </button>
                    </div>
                    <div id="faq{{$f}}" class="collapse @if($f==0) show @endif" data-parent="#accordionfaq">
                      <div class="faq-body">
                        {{$faq->description??''}}
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div> 
                <!-- faqpageaccordion  -->
              </div>
            </div>
            <!--content-area-->         
        </div>
        <!--container-->
      </div>     
      <!--content-wrapper-->
    </section>
@endsection