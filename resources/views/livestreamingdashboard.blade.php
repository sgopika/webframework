@extends('layouts.basemain')

@section('content')
<div class="container-fluid homepage adminpage">
<div class="row ">
    <div class="col-12 py-2  ">
        <!-- breadcrumb if, needed -->
    </div> <!-- col12 -->
    <div class="col-12 py-1 px-2 ">
        <p class="eng_xxs px-3 fg-darkBrown"> Live Streaming Dashboard </p>
    </div> <!-- ./col12 --> 
    <div class="col-12 ">
        <div class="row">

            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Live Streaming</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('livestreaming.livestreaminglist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
