@extends('layouts.basemain')

@section('content')
<div class="container-fluid homepage adminpage">
<div class="row ">
    <div class="col-12 py-2  ">
        <!-- breadcrumb if, needed -->
    </div> <!-- col12 -->
    <div class="col-12 py-1 px-2 ">
        <p class="eng_xxs px-3 fg-darkBrown"> Editor Dashboard </p>
    </div> <!-- ./col12 --> 
    <div class="col-12 ">
        <div class="row">
        	<div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">About Department</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.aboutdepartmentlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">About Portal</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.aboutportallist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Activity</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.activitylist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Activity Uploads</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.activityuploadlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Article</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.articlelist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Article Uploads</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.articleuploadlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Department Introduction</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.deptintrolist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Downloads</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.downloadlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                             <a href="{{ route('editor.gallerylist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                             <a href="{{ route('editor.galleryalbumlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Live Streaming</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.livestreaminglist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Long Alert</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.longalertlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Media Alert</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.mediaalertlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                             <a href="{{ route('editor.newsletterlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                             <a href="{{ route('editor.newslettervolumelist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Short Alert</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.shortalertlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">What's New</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('editor.whatisnewlist') }}" class=" nolink btn btn-sm widgetbutton px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
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
