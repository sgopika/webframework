@extends('layouts.basemain')
@section('content')
<!-- Start of breadcrumb -->

<!-- End of breadcrumb -->
<div class="container-fluid homepage adminpage">
<div class="row ">
  <div class="col-12 py-2  ">
    <nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
      <ol class="breadcrumb justify-content-end px-3 pt-2">

          @if(Auth::user()->usertypes_id==3)
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('siteadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
           @elseif(Auth::user()->usertypes_id==4)
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('webadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         @elseif(Auth::user()->usertypes_id==5)
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('editorhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         @endif
      </ol>
      
    </nav>
  </div> <!-- col12 -->
  <div class="col-12 py-1 px-2 ">
    <p class="eng_xxs px-3 fg-darkBrown"> Activity List </p>
  </div> <!-- ./col12 -->
  <div class="col-12 py-1">
      @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
   @if(session()->get('errors'))
    <div class="alert alert-danger">
      {{ session()->get('errors') }}
    </div>
  @endif
    </div>

  <div class="col-12 py-1">
     <button type="button" class="btn btn-sm  text-white bg-magenta fg-lighTaupe eng_xxxs"  id="transactionbutton" name="transactionbutton"> <i class="fas fa-plus-square "></i>&nbsp;Add New</button>
     <input type="hidden" id="usertypeid" name="usertypeid" value="{{ Auth::user()->usertypes_id }}">
     <!-- Button trigger modal -->

  </div> <!-- ./col12 -->
  <div class="col-12 py-1">
    <div class="responsive">
          <table class="table table-stripped table-sm table-hover box-shadow--6dp" id="resposivetable">
            <thead class="eng_xxxs thlist">
              <tr class="bg-teal">
                <th>#</th>
                <th>Title</th>
                <th>Title in Malayalam</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="eng_xxxs">
               @php
                $i=1
                @endphp

                @foreach($listdata as $res)

                <tr>
                    <td><span class="eng_xxxxs"> {{ $i }} </span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->entitle }} </span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->maltitle }} </span> </td>
                  
                  <td><span class="active" id="{{ $res->id }}"> @if($res->status==1)<i class="fas fa-check-square"></i>@elseif($res->status==2)  <i class="fas fa-window-close fg-darkTaupe"></i>@endif </span></td>
                  <td>
                  @if($res->contributor_status==2)
                  Moderator : <span class="eng_xxxxs text-danger"> {{ $res->moderator_remarks }} </span><br>
                  @if(isset($res->approve_remarks)) Publisher : <span class="eng_xxxxs text-danger"> {{ $res->approve_remarks }} </span>@endif<hr class="py-1">
                  @endif
                  <div class="btn-group" role="group" aria-label="Actionbuttons">
              
              <button type="button" class="edit btn btn-sm bg-lightBrown fg-darkCrimson eng_xxxxs " name="edit" id="{{ $res->id }}" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="fas fa-pencil-alt"></i>&nbsp;Edit</button>
              <button type="button" class="delete btn btn-sm bg-darkBrown fg-lightGray eng_xxxxs" name="delete" id="{{ $res->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
            </div>
                  </td>
                  @php
                  $i++
                  @endphp

                  @endforeach
              </tr>
              
            </tbody>
          </table>
        </div>
  </div> <!-- ./col12 -->
</div> <!-- ./row -->
</div> <!-- ./container -->
<!-- Modal -->
<div class="modal fade"  id="transactionmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header modalover">
        <p class="modal-title eng_xxs fg-darkEmerald" id="addmodalLabel"><i class="fab fa-wpforms"></i>&nbsp;Modal title</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- ./modal-header -->
      
        @if(Auth::user()->usertypes_id==4)
      <form action="{{ route('webadmin.activitystore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
        @elseif(Auth::user()->usertypes_id==3)
     <form action="{{ route('siteadmin.activitystore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
      @elseif(Auth::user()->usertypes_id==5)
     <form action="{{ route('editor.activitystore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
      @elseif(Auth::user()->usertypes_id==6)
     
      @endif
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
         
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Poster </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="file"  id="image" name="image" required>
                  <p id="imageerror" style="display:none; color:#FF0000;">
                  Invalid File format. 
                  </p>
                  <p id="imageerror1" style="display:none; color:#FF0000;" class="mal_xxxs">
                  Allowed size 1 MB.
                  </p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Alternative Text </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="alttext" name="alttext" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="alttexterror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entitle" name="entitle" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="titleerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltitle" name="maltitle" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                <p id="maltitleerror" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Tooltip </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entooltip" name="entooltip" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="tooltiperror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Tooltip in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltooltip" name="maltooltip" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                <p id="maltooltiperror" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Sub Title </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="ensubtitle" name="ensubtitle" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="subtitleerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Sub Title in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malsubtitle" name="malsubtitle" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="100" minlength="3">
                <p id="malsubtitleerror" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Author </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="enauthor" name="enauthor" aria-describedby="HELPNAME" placeholder="Name" maxlength="200" minlength="3">
                <p id="authorerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Author in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malauthor" name="malauthor" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="500" minlength="3">
                <p id="malauthorerror" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Brief </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enbrief" name="enbrief" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="enbrief" name="enbrief" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea>
                <p id="brieferror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Brief in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malbrief" name="malbrief" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="malbrief" name="malbrief" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Content </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="encontent" name="encontent" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="encontent" name="encontent" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea>
                <p id="contenterror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Content in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
               <!--  <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malcontent" name="malcontent" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea> -->
               <textarea class="summernote" id="malcontent" name="malcontent" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Activity Type </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <select class="form-control customform eng_xxxs fg-darkCrimson" id="activitytypes_id" name="activitytypes_id" required></select>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Start Date</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" name="startdate" id="startdate" value="{{ Carbon\Carbon::now()->format('d/m/Y')  }}" class="form-control customform eng_xxxs fg-darkCrimson dob" required>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">End Date</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" name="enddate" id="enddate" value="{{ Carbon\Carbon::now()->format('d/m/Y')  }}" class="form-control customform eng_xxxs fg-darkCrimson dob" required>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
         <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Display on Homepage </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="checkbox" id="homepagestatus" value="1" name="homepagestatus" >
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          

        </div> <!-- ./form_section -->

      </div> <!-- ./modal-body -->
      <div class="modal-footer modalover">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <button type="submit" class="btn btn-sm btn-flat eng_xxxs fg-grayWhite bg-darkMagenta"> <i class="fas fa-save"></i> &nbsp;Save changes</button>

      </div> <!-- ./modal-footer  -->
    </form>
    </div> <!-- ./modal-content -->
  </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->

<!-- Modal -->
<div class="modal fade"  id="transactionmodal1" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header modalover">
        <p class="modal-title eng_xxs fg-darkEmerald" id="addmodalLabel"><i class="fab fa-wpforms"></i>&nbsp;Modal title</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- ./modal-header -->
      
          @if(Auth::user()->usertypes_id==4)
      <form action="{{ route('webadmin.activityupdate') }}" id="ajaxmodalform1" method="post" class="form-horizontal" enctype="multipart/form-data">
        @elseif(Auth::user()->usertypes_id==3)
      <form action="{{ route('siteadmin.activityupdate') }}" id="ajaxmodalform1" method="post" class="form-horizontal" enctype="multipart/form-data">
      @elseif(Auth::user()->usertypes_id==5)
      <form action="{{ route('editor.activityupdate') }}" id="ajaxmodalform1" method="post" class="form-horizontal" enctype="multipart/form-data">
        
     
      @endif
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
          
          <div class="row customformrow" >
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Poster </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <img src="" class="img-thumbnail displaythumbnail customform eng_xxxs fg-darkCrimson" alt="Image" id="uploadedimage">
                <input type="file"  id="imageedit" name="imageedit" >
                  <p id="imageerror2" style="display:none; color:#FF0000;">
                  Invalid File format.
                  </p>
                  <p id="imageerror3" style="display:none; color:#FF0000;" class="mal_xxxs">
                  Allowed size 1 MB.
                  </p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Alternative Text </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="alttext1" name="alttext1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="alttexterror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entitle1" name="entitle1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="titleerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltitle1" name="maltitle1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                <p id="maltitleerror1" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Tooltip </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entooltip1" name="entooltip1" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="tooltiperror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Tooltip in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltooltip1" name="maltooltip1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                <p id="maltooltiperror1" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Sub Title </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="ensubtitle1" name="ensubtitle1" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="subtitleerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Sub Title in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malsubtitle1" name="malsubtitle1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="100" minlength="3">
                <p id="malsubtitleerror1" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Author </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="enauthor1" name="enauthor1" aria-describedby="HELPNAME" placeholder="Name" maxlength="200" minlength="3">
                <p id="authorerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Author in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malauthor1" name="malauthor1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="500" minlength="3">
                <p id="malauthorerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Brief </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enbrief1" name="enbrief1" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="enbrief1" name="enbrief1" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea>
                <p id="brieferror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Brief in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malbrief1" name="malbrief1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="malbrief1" name="malbrief1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Content </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="encontent1" name="encontent1" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="encontent1" name="encontent1" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea>
                <p id="contenterror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Content in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malcontent1" name="malcontent1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="malcontent1" name="malcontent1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Activity Type </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <select class="form-control customform eng_xxxs fg-darkCrimson" id="activitytypes_id1" name="activitytypes_id1" required></select>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Start Date</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" name="startdate1" id="startdate1" value="{{ Carbon\Carbon::now()->format('d/m/Y')  }}" class="form-control customform eng_xxxs fg-darkCrimson dob" required>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">End Date</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" name="enddate1" id="enddate1" value="{{ Carbon\Carbon::now()->format('d/m/Y')  }}" class="form-control customform eng_xxxs fg-darkCrimson dob" required>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          
         <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Display on Homepage </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="checkbox" id="homepagestatus1" value="1" name="homepagestatus1" >
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->

        </div> <!-- ./form_section -->

      </div> <!-- ./modal-body -->
      <div class="modal-footer modalover">
        <input type="hidden" name="action" id="action1" value="Add" />
        <input type="hidden" name="hidden_id1" id="hidden_id1" />
        <button type="submit" class="btn btn-sm btn-flat eng_xxxs fg-grayWhite bg-darkMagenta"> <i class="fas fa-save"></i> &nbsp;Save changes</button>

      </div> <!-- ./modal-footer  -->
    </form>
    </div> <!-- ./modal-content -->
  </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->

<div id="confirmModal" class="modal" tabindex="-1"  role="dialog">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div> <!-- ./modal-header -->
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div> <!-- ./modal-body -->
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div> <!-- ./modal-footer -->
        </div> <!-- ./modal-content -->
    </div> <!-- ./modal-dialog -->
</div> <!-- ./confirm modal dialog -->

@endsection

@section('customscripts')
<script>
$(document).ready(function(){ 

  $('.summernote').summernote({
      toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    ['para', ['ul', 'ol', 'paragraph']],

  ],

  });

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$('#resposivetable').DataTable( {
    responsive: true,
    aoColumnDefs: [
  {
     bSortable: false,
     aTargets: [ -1 ]
  }
]
} );
 

  $('#title').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#title').val('');
    
     $('#titleerror').slideDown("slow");

  }
  else
  {
     $('#titleerror').hide();
     
  }
      
});
$('#title1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#title1').val('');
    
     $('#titleerror1').slideDown("slow");

  }
  else
  {
     $('#titleerror1').hide();
     
  }
      
});

$('#ensubtitle').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#ensubtitle').val('');
    
     $('#subtitleerror').slideDown("slow");

  }
  else
  {
     $('#subtitleerror').hide();
     
  }
      
});

  $('#ensubtitle1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#ensubtitle1').val('');
    
     $('#subtitleerror1').slideDown("slow");

  }
  else
  {
     $('#subtitleerror1').hide();
     
  }
      
});


  $('#enauthor').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enauthor').val('');
    
     $('authorerror').slideDown("slow");

  }
  else
  {
     $('#authorerror').hide();
     
  }
      
});

  $('#enauthor1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enauthor1').val('');
    
     $('#authorerror1').slideDown("slow");

  }
  else
  {
     $('#authorerror1').hide();
     
  }
      
});

  $('#enbrief').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enbrief').val('');
    
     $('brieferror').slideDown("slow");

  }
  else
  {
     $('#brieferror').hide();
     
  }
      
});

  $('#enbrief1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enbrief1').val('');
    
     $('#brieferror1').slideDown("slow");

  }
  else
  {
     $('#brieferror1').hide();
     
  }
      
});

  $('#encontent').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#encontent').val('');
    
     $('contenterror').slideDown("slow");

  }
  else
  {
     $('#contenterror').hide();
     
  }
      
});

  $('#encontent1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#encontent1').val('');
    
     $('#contenterror1').slideDown("slow");

  }
  else
  {
     $('#contenterror1').hide();
  }
      
});

$('#entooltip').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#entooltip').val('');
    
     $('tooltiperror').slideDown("slow");

  }
  else
  {
     $('#tooltiperror').hide();
     
  }
      
});

  $('#entooltip1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#entooltip1').val('');
    
     $('#tooltiperror1').slideDown("slow");

  }
  else
  {
     $('#tooltiperror1').hide();
  }
      
});
  

  $('#alttext').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#alttext').val('');
    
     $('#alttexterror').slideDown("slow");

  }
  else
  {
     $('#alttexterror').hide();
     
  }
      
});

  $('#alttext1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#alttext1').val('');
    
     $('#alttexterror1').slideDown("slow");

  }
  else
  {
     $('#alttexterror1').hide();
     
  }
      
});

  $('#extras').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#extras').val('');
    
     $('#extraserror').slideDown("slow");

  }
  else
  {
     $('#extraserror').hide();
     
  }
      
});

  $('#extras1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#extras1').val('');
    
     $('#extraserror1').slideDown("slow");

  }
  else
  {
     $('#extraserror1').hide();
     
  }
      
});

//////////////////////////////////////////////
$('#maltooltip').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#maltooltiperror').hide();
}
else{
$('#maltooltip').val('');
  $('#maltooltiperror').slideDown("slow");
}
      
});
$('#maltooltip1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#maltooltiperror1').hide();
}
else{
$('#maltooltip1').val('');
  $('#maltooltiperror1').slideDown("slow");
}
      
});

$('#maltitle').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#maltitleerror').hide();
}
else{
$('#maltitle').val('');
  $('#maltitleerror').slideDown("slow");
}
      
});
$('#maltitle1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#maltitleerror1').hide();
}
else{
$('#maltitle1').val('');
  $('#maltitleerror1').slideDown("slow");
}
      
});

$('#malsubtitle').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#malsubtitleerror').hide();
}
else{
$('#malsubtitle').val('');
  $('#malsubtitleerror').slideDown("slow");
}
      
});
$('#malsubtitle1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#malsubtitleerror1').hide();
}
else{
$('#malsubtitle1').val('');
  $('#malsubtitleerror1').slideDown("slow");
}
      
});

$('#malauthor').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#malauthorerror').hide();
}
else{
$('#malauthor').val('');
  $('#malauthorerror').slideDown("slow");
}
      
});

$('#malauthor1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#malauthorerror1').hide();
}
else{
$('#malauthor1').val('');
  $('#malauthorerror1').slideDown("slow");
}
      
});
/////////////////////////////////////////////

$('#image').bind('change', function() {
    
    var ext = $('#image').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#imageerror').slideDown("slow");
      $('#imageerror1').slideUp("slow");
      $('#image').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#imageerror1').slideDown("slow");
        $('#image').val('');
     
      }else{
     
        $('#imageerror1').slideUp("slow");
      }
      $('#imageerror').slideUp("slow");
    }
  });

  $('#imageedit').bind('change', function() {
    
    var ext = $('#image1').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#imageerror2').slideDown("slow");
      $('#imageerror3').slideUp("slow");
      $('#image1').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#imageerror3').slideDown("slow");
        $('#image1').val('');
     
      }else{
     
        $('#imageerror3').slideUp("slow");
      }
      $('#imageerror2').slideUp("slow");
    }
  });



$("#transactionbutton").click(function(event){
    event.preventDefault();
    $('.modal-title').text('Add New Activity');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');
  var usertype=$("#usertypeid").val(); 
  var action_url = '';
  if(usertype==4){
     action_url = "{{ route('webadmin.activitycreate') }}";
  } else if(usertype==3){
     action_url = "{{ route('siteadmin.activitycreate') }}";
  } else if(usertype==5){
     action_url = "{{ route('editor.activitycreate') }}";
  } 
    
  $.ajax({
       url:action_url ,
       dataType:"json",
       success:function(data)
        {
            

            /*$('#filetypes_id').empty();
            $('#filetypes_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.filetype, function(index, element) {
                $('#filetypes_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });*/

           

            $('#activitytypes_id').empty();
            $('#activitytypes_id').append($('<option></option>').val('').html('Select'));
            $.each(data.activitytype, function(index, element) {
                $('#activitytypes_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });

            

            

            $('#entitle').val('');
            $('#maltitle').val('');
            $('#ensubtitle').val('');
            $('#malsubtitle').val('');
            $('#enauthor').val('');
            $('#malauthor').val('');
            $('#enbrief').val('');
            $('#malbrief').val('');
            $('#encontent').val('');
            $('#malcontent').val('');
            
            $('#alttext').val('');

            
            $('.modal-title').text('Add New Activity');
            $('#actionbutton').val('Save Details');
            $('#action').val('Add');
            $('#ajaxformresults').html('');
            $("#transactionmodal").modal('show');
        }
       })
    
});



/*$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
    var action_url = '';
    if($('#action').val() == 'Add')
        action_url = "{{ route('appadmin.officestore') }}";

    if($('#action').val() == 'Edit')
        action_url = "{{ route('appadmin.officeupdate') }}";

    $.ajax({
         url: action_url,
         method:"post",
         data:$(this).serialize(),
         dataType:"json",
         success:function(data)
         { 
            var html = '';
            if(data.errors)
            {
               alert("Already a department with same name exists");
               
            }
            if(data.success)
            {
               html = '<div class="alert alert-success">' + data.success + '</div>';
               $('#ajaxmodalform')[0].reset();
               window.location.reload();
               $('#transactionmodal').modal('hide');
            }
         }
    });
  });*/
  

 
 

  $(document).on('click', '.edit', function(){
      var id = $(this).attr('id'); 
      $('#ajaxformresults').html('');
      var usertype=$("#usertypeid").val(); 
      var action_url2 = '';
      if(usertype==4){
         action_url2 = "/webadmin/activityedit/"+id;
      } else if(usertype==3){
         action_url2 = "/siteadmin/activityedit/"+id;
      } else if(usertype==5){
         action_url2 = "/editor/activityedit/"+id;
      } 
      $.ajax({
       url :action_url2,
       dataType:"json",
       success:function(data)
        { 
          if(data.error){
            alert("The Activity is Locked, So cannot be edited!");
          } else {
            $("#uploadedimage").attr('src',"{{asset('Activity')}}/"+data.resultdata.poster);  
            $('#entitle1').val(data.resultdata.entitle);
            $('#maltitle1').val(data.resultdata.maltitle);
            $('#entooltip1').val(data.resultdata.entooltip);
            $('#maltooltip1').val(data.resultdata.maltooltip);
            $('#ensubtitle1').val(data.resultdata.ensubtitle);
            $('#malsubtitle1').val(data.resultdata.malsubtitle);
            $('#enauthor1').val(data.resultdata.enauthor);
            $('#malauthor1').val(data.resultdata.malauthor);
            /*$('#enbrief1').val(data.resultdata.enbrief);
            $('#malbrief1').val(data.resultdata.malbrief);
            $('#encontent1').val(data.resultdata.encontent);
            $('#malcontent1').val(data.resultdata.malcontent);*/
            $('#enbrief1').summernote('code', data.resultdata.enbrief);
            $('#malbrief1').summernote('code', data.resultdata.malbrief);
            $('#encontent1').summernote('code', data.resultdata.encontent);
            $('#malcontent1').summernote('code', data.resultdata.malcontent);
            $('#alttext1').val(data.resultdata.alt);
            
            if(data.resultdata.homepagestatus==1){
              $('#homepagestatus1').prop('checked', true);
            } else {
              $('#homepagestatus1').prop('checked', false);
            }


            

            $('#activitytypes_id1').empty();
            $('#activitytypes_id1').append($('<option></option>').val('').html('Select'));
            $.each(data.activitytype, function(index, element) {
                $('#activitytypes_id1').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
                element.id == data.resultdata.activitytypes_id ? $('#activitytypes_id1').val(element.id).prop('selected', true) : '';
            });

            var start = new Date(data.resultdata.startdate);
            var dd = start.getDate();
            var mm = start.getMonth()+1; //January is 0! 
            var yyyy = start.getFullYear();
            if(dd<10){dd='0'+dd};
            if(mm<10){mm='0'+mm};
            var start = dd+'/'+mm+'/'+yyyy; 
            $('#startdate1').val(start);

            var end = new Date(data.resultdata.enddate);
            var dd1 = end.getDate();
            var mm1 = end.getMonth()+1; //January is 0! 
            var yyyy1 = end.getFullYear();
            if(dd1<10){dd1='0'+dd1};
            if(mm1<10){mm1='0'+mm1};
            var end = dd1+'/'+mm1+'/'+yyyy1; 
            $('#enddate1').val(end);
            
           
           
            $('#hidden_id1').val(id);
            $('.modal-title').text('Edit Details');
            $('#actionbutton1').val('Update Details');
            $('#action1').val('Edit');
            $('#transactionmodal1').modal('show');
          }
                  
          
        }
      })
  });

   $(document).on('click', '.active', function(){

    var id = $(this).attr('id'); 
     var usertype=$("#usertypeid").val(); 
      var action_url3 = '';
      if(usertype==4){
         action_url3 = "/webadmin/activitystatus/"+id;
      } else if(usertype==3){
         action_url3 = "/siteadmin/activitystatus/"+id;
      } else if(usertype==5){
         action_url3 = "/editor/activitystatus/"+id;
      } 
    $.ajax({
      url:action_url3,
      dataType:"json",

      success:function(data)
      {
        if(data.error)
        {
          //alert("Already an active Alert exists!!!");
          
        }
        if(data.success)
        { 
          window.location.reload();
        } 
         
        
      }
    })
  });

  var element_id;

  $(document).on('click', '.delete', function(){
      element_id = $(this).attr('id');
      $('#confirmModal').modal('show');
  });

  $('#ok_button').click(function(){
    var usertype=$("#usertypeid").val(); 
      var action_url4 = '';
      if(usertype==4){
         action_url4 = "/webadmin/activitydestroy/"+element_id;
      } else if(usertype==3){
         action_url4 = "/siteadmin/activitydestroy/"+element_id;
      } else if(usertype==5){
         action_url4 = "/editor/activitydestroy/"+element_id;
      } 

    $.ajax({
            url:action_url4,
            dataType:"json",

            success:function(data)
            {
               setTimeout(function(){
               $('#confirmModal').modal('hide');
               window.location.reload();
               alert('Data Deleted');
               }, 200);
            }
    })
});



$( ".close1" ).click(function() {
      $('#transactionmodal').modal('hide');
        
 });

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection