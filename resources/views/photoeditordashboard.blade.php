@extends('layouts.basemain')

@section('content')
<div class="container-fluid homepage adminpage">
<div class="row ">
    <div class="col-12 py-2  ">
        <!-- breadcrumb if, needed -->
    </div> <!-- col12 -->
    <div class="col-12 py-1 px-2 ">
        <p class="eng_xxs px-3 fg-darkBrown"> Photo Editor Dashboard </p>
    </div> <!-- ./col12 --> 
    <div class="col-12 ">
        <div class="row">

            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Downloads</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('photoeditor.downloadlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Gallery</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('photoeditor.gallerylist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

             <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Gallery Albums</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('photoeditor.galleryalbumlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Newsletter</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('photoeditor.newsletterlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Newsletter volumes</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('photoeditor.newslettervolumelist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->


            
            
        </div> <!-- ./inner-row -->
    </div> <!-- ./col12 -->
</div> <!-- ./row -->
</div> <!-- ./container -->
@endsection
