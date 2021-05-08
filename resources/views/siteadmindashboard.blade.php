@extends('layouts.basemain')

@section('content')
<div class="container-fluid homepage adminpage">
<div class="row ">
    <div class="col-12 py-2  ">
        <!-- breadcrumb if, needed -->
    </div> <!-- col12 -->
    <div class="col-12 py-1 px-2 ">
        <p class="eng_xxs px-3 fg-darkBrown">Site Admin Dashboard </p>
    </div> <!-- ./col12 --> 
    <div class="col-12 ">
        <div class="row">

            <!-- About Department -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.aboutdepartmentlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- About Department -->


            <!-- About Portal -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.aboutportallist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- About Portal -->
            <!-- Activity type -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Activity type</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.activitytypelist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Activity type -->

           <!-- Activity -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.activitylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
         <!-- Activity -->
         <!--Address with map -->
           <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Address with map</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.addresswithmaplist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           <!--Address with map -->
           <!-- Archive Policy -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Archive Policy</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.archivepolicylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- Archive Policy -->
            <!-- Article Category -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Article Category</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.articlecategorylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Article Category -->
            <!-- Article -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.articlelist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
         <!-- Article -->
            
             <!--  Button -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Button</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.buttonlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!--  Button -->
            <!-- Header Button -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Header Button</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.headerbuttonlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Header Button -->
           <!-- Contact Us -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Contact Us</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.contactuslist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- Contact Us -->
            <!-- Copyright policy -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Copyright Policy</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.copyrightpolicylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- Copyright policy -->
            <!-- Department Introduction -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.deptintrolist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- Department Introduction -->
             <!-- Digital info -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Digital info</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.digitalinfolist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- Digital info -->
           <!-- FAQ -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">FAQ</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.faqlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- FAQ -->
          <!-- Footer -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Footer</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.footerlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Footer -->
            <!-- Footer Menu -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Footer Menu</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.footermenulist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Footer Menu -->
             <!-- Footer Link -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Footer Link</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.footerlinklist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Footer Link -->
            
             <!-- Gallery -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.gallerylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
         <!-- Gallery -->
            <!-- Guidelines -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Guidelines</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.guidelinelist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!--Guidelines -->
            <!-- Help -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Help</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.helplist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!--Help -->

            <!-- Hyperlink policy -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Hyperlink Policy</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.hyperlinkpolicylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- Hyperlink policy -->
            <!-- Logo -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Logo</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.logolist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Logo -->
            <!-- Long Alert -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.longalertlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
         <!-- Long Alert -->

           <!-- Media Alert -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.mediaalertlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
         <!-- Media Alert -->
          <!-- Main menu -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Main menu</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.mainmenulist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- Main Menu -->
           <!-- Privacy policy -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Privacy Policy</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.privacypolicylist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- Privacy policy -->
             <!--Service Info -->
           <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Service Info</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.serviceinfolist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           <!--Service Info -->
         <!-- Service link -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Service link</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.servicelinklist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
          <!-- Service link -->

            <!-- Short Alert -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.shortalertlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
         <!-- Short Alert -->
          <!-- Site compatibility info -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Site compatibility info</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.sitecompinfolist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- Site compatibility info -->
            
             <!-- Social Media -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Social Media</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.socialmedialist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           <!-- Social Media -->
    
            <!-- Sub menu -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Sub menu</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.submenulist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- Sub Menu -->

  <!-- Support centers -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Support centers</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.supportcenterlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- Support centers -->
            <!-- Terms and Conditions -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Terms and Conditions</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.termsandconditionlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
           
           <!-- Terms and Conditions -->

            <!-- Title -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
                <div class="card-body  ">
                    <blockquote class="blockquote ">
                        <p class="mb-0 font-weight-bold eng_xxs fg-darkOlive">Title</p>
                        <p class="eng_xxxs fg-darkGrayBlue"> List </p>
                    </blockquote>
                    <div class="w-100 pb-1"></div>
                    <div class="d-flex align-items-center align-self-end">
                        <div class="meta-author">
      
                        </div>
                        <div class="meta-item ml-auto">
                             <a href="{{ route('siteadmin.titlelist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->
            <!-- Title -->
           
           
             <!-- What's New -->
            <div class="col-3 py-3">
                <!-- card-widget -->
                <div class="card  border-light  cardwidget shadow dashwidget">
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
                             <a href="{{ route('siteadmin.whatisnewlist') }}" class=" nolink btn btn-sm widgetbutton  px-3 eng_xxxs"> <i class="fas fa-arrow-alt-circle-right"></i> View </a>
                        </div>
                    </div>
                 </div> <!-- ./card-body -->
                </div> <!-- ./card -->
                <!-- ./card-widget -->
            </div> <!-- ./col3 -->

           <!-- What's New -->
    
        </div> <!-- ./inner-row -->
    </div> <!-- ./col12 -->
</div> <!-- ./row -->
</div> <!-- ./container -->
@endsection
