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
     <input type="hidden" name="usertypeid" id="usertypeid" value="{{ Auth::user()->usertypes_id }}">
     <!-- Button trigger modal -->

  </div> <!-- ./col12 -->
  <div class="col-12 py-1">
    <div class="responsive">
          <table class="table table-stripped table-sm table-hover box-shadow--6dp" id="resposivetable">
            <thead class="eng_xxxs thlist">
              <tr class="bg-teal">
                <th>#</th>
                <th>User Name</th>
                <th>Designation</th>
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
                    <td><span class="eng_xxxxs"> {{ $res->entitle }} <hr class="py-1"> {{ $res->maltitle }}</span> </td>
                     <td><span class="eng_xxxxs"> {{ $res->endesg1 }} <hr class="py-1"> {{ $res->endesg2 }}</span> </td>
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
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header modalover">
        <p class="modal-title eng_xxs fg-darkEmerald" id="addmodalLabel"><i class="fab fa-wpforms"></i>&nbsp;Modal title</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- ./modal-header -->
      <form  id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">

          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">USER 1 </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <label for="IDNAME" class="eng_xxxs fg-darkBrown">USER 2 </label>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Image </label>
              <img src="" class="img-thumbnail displaythumbnail customform eng_xxxs fg-darkCrimson" alt="Image" id="uploadedimage1">
              <input type="file"  id="image1" name="image1" >
                  <p id="imageerror1" style="display:none; color:#FF0000;">
                  Allowed Image Formats: .jpg, .png, .jpeg 
                  </p>
                  <p id="imageerror2" style="display:none; color:#FF0000;" class="mal_xxxs">
                  Allowed size 1 MB.
                  </p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Image </label>
              <img src="" class="img-thumbnail displaythumbnail customform eng_xxxs fg-darkCrimson" alt="Image" id="uploadedimage2">
                <input type="file"  id="image2" name="image2" >
                  <p id="imageerror3" style="display:none; color:#FF0000;">
                  Allowed Image Formats: .jpg, .png, .jpeg 
                  </p>
                  <p id="imageerror4" style="display:none; color:#FF0000;" class="mal_xxxs">
                  Allowed size 1 MB.
                  </p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Alternative Text </label>
              <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="alttext1" name="alttext1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="alttexterror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
               <label for="IDNAME" class="eng_xxxs fg-darkBrown">Alternative Text </label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="alttext2" name="alttext2" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="alttexterror2" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name </label>

              <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="name1" name="name1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="nameerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name </label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="name2" name="name2" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="nameerror2" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam</label>
               <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname1" name="malname1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                 <p id="malnameerror2" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam</label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname2" name="malname2" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                 <p id="malnameerror2" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Designation</label>
              <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="desgn1" name="desgn1" aria-describedby="HELPNAME" placeholder="Enter the Designation" maxlength="50" minlength="3">
              <p id="desgnerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
               <label for="IDNAME" class="eng_xxxs fg-darkBrown">Designation</label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="desgn2" name="desgn2" aria-describedby="HELPNAME" placeholder="Enter the Designation" maxlength="50" minlength="3">
                <p id="desgnerror2" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Malayalam Designation</label>
              <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maldesgn1" name="maldesgn1" aria-describedby="HELPNAME" placeholder="Enter the Designation" maxlength="50" minlength="3">
                <p id="maldesgnerror1" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
               <label for="IDNAME" class="eng_xxxs fg-darkBrown">Malayalam Designation</label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maldesgn2" name="maldesgn2" aria-describedby="HELPNAME" placeholder="Enter the Designation" maxlength="50" minlength="3">
                <p id="maldesgnerror2" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Tooltip </label>
               <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entooltip" name="entooltip" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="entooltiperror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
               <label for="IDNAME" class="eng_xxxs fg-darkBrown">Tooltip in Malayalam</label>
               <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltooltip" name="maltooltip" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
               <p id="maltooltiperror" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title </label>
               <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entitle" name="entitle" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="entitleerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title in Malayalam</label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltitle" name="maltitle" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="100" minlength="3">
                  <p id="maltitleerror" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
         
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Sub Title </label>
               <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="ensubtitle" name="ensubtitle" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="ensubtitleerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <label for="IDNAME" class="eng_xxxs fg-darkBrown">Sub Title in Malayalam</label>
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malsubtitle" name="malsubtitle" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="100" minlength="3">
                <p id="malsubtitleerror" style="display:none; color:#FF0000;" >Only malyalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
         
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Brief </label>
              <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enbrief" name="enbrief" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea> -->
              <textarea class="summernote" id="enbrief" name="enbrief" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea>
                <p id="brieferror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <label for="IDNAME" class="eng_xxxs fg-darkBrown">Brief in Malayalam</label>
                  <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malbrief" name="malbrief" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea> -->
                  <textarea class="summernote" id="malbrief" name="malbrief" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Content </label>
              <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="encontent" name="encontent" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3"></textarea> -->
              <textarea class="summernote" id="encontent" name="encontent" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
                <p id="contenterror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <label for="IDNAME" class="eng_xxxs fg-darkBrown">Content in Malayalam</label>
                <!-- <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malcontent" name="malcontent" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea> -->
                <textarea class="summernote" id="malcontent" name="malcontent" placeholder="Name in Malayalam" maxlength="1000" minlength="3"></textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
         
           <div class="row customformrow">
            <div class="col-md-6 py-2">
             <label for="IDNAME" class="eng_xxxs fg-darkBrown">Icon Class </label>
               <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="icon" name="icon" aria-describedby="HELPNAME" placeholder="Placeholder value">
              <p id="iconerror" style="display:none; color:#FF0000;" >Only A -Z a-z and numbers allowed.</p>
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
               <label for="IDNAME" class="eng_xxxs fg-darkBrown">Display on Homepage </label>
                <input type="checkbox" class="form-control customform" id="homepagestatus" value="1" name="homepagestatus" >
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
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'video']],
    ['view', ['fullscreen', 'codeview', 'help']],

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
 

  $('#image1').bind('change', function() {
    
    var ext = $('#image1').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#imageerror1').slideDown("slow");
      $('#imageerror2').slideUp("slow");
      $('#image1').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#imageerror2').slideDown("slow");
        $('#image1').val('');
     
      }else{
     
        $('#imageerror2').slideUp("slow");
      }
      $('#imageerror1').slideUp("slow");
    }
  });
  
  
  $('#image2').bind('change', function() {
    
    var ext = $('#image2').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#imageerror3').slideDown("slow");
      $('#imageerror4').slideUp("slow");
      $('#image2').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#imageerror4').slideDown("slow");
        $('#image2').val('');
     
      }else{
     
        $('#imageerror4').slideUp("slow");
      }
      $('#imageerror3').slideUp("slow");
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

 $('#alttext2').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#alttext2').val(''); 
     $('#alttexterror2').slideDown("slow");
  }
  else
  {
     $('#alttexterror2').hide();
     
  }
      
});


$('#name1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#name1').val(''); 
     $('#nameerror1').slideDown("slow");
  }
  else
  {
     $('#nameerror1').hide();
     
  }
      
});

 $('#name2').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#name2').val(''); 
     $('#nameerror2').slideDown("slow");
  }
  else
  {
     $('#nameerror2').hide();
     
  }
      
});


$('#malname1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#malnameerror1').hide();
}
else{
 // console.log("not Valid");
$('#malname1').val('');
  $('#malnameerror1').slideDown("slow");
}
      
}); 


$('#malname2').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#malnameerror2').hide();
}
else{
 // console.log("not Valid");
$('#malname2').val('');
  $('#malnameerror2').slideDown("slow");
}
      
}); 



$('#desgn1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#desgn1').val(''); 
     $('#desgnerror1').slideDown("slow");
  }
  else
  {
     $('#desgnerror1').hide();
     
  }
      
});

$('#desgn2').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#desgn2').val(''); 
     $('#desgnerror2').slideDown("slow");
  }
  else
  {
     $('#desgnerror2').hide();
     
  }
      
});


$('#maldesgn1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#maldesgnerror1').hide();
}
else{
 // console.log("not Valid");
$('#maldesgn1').val('');
  $('#maldesgnerror1').slideDown("slow");
}
      
}); 


$('#maldesgn2').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#maldesgnerror2').hide();
}
else{
 // console.log("not Valid");
$('#maldesgn2').val('');
  $('#maldesgnerror2').slideDown("slow");
}
      
}); 


$('#entooltip').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#entooltip').val(''); 
     $('#entooltiperror').slideDown("slow");
  }
  else
  {
     $('#entooltiperror').hide();   
  }
      
});



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



 $('#entitle').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#entitle').val(''); 
     $('#entitleerror').slideDown("slow");
  }
  else
  {
     $('#entitleerror').hide();
     
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



$('#icon').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#icon').val(''); 
     $('#iconerror').slideDown("slow");
  }
  else
  {
     $('#iconerror').hide();
     
  }
      
});

$("#transactionbutton").click(function(event){
    event.preventDefault();
    $('.modal-title').text('Add New Office');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');

    $('#name1').val('');
    $('#name2').val('');
    $('#malname1').val('');
    $('#malname2').val('');
    $('#desgn1').val('');
     $('#desgn2').val(''); 
     $('#maldesgn1').val('');
     $('#maldesgn2').val('');
     $('#alttext1').val('');
     $('#alttext2').val('');
     $('#enbrief').val('');
     $('#malbrief').val('');
      $('#entooltip').val('');
      $('#maltooltip').val('');
      $('#entitle').val('');
      $('#maltitle').val('');
      $('#ensubtitle').val('');
      $('#malsubtitle').val('');
      $('#encontent').val('');
      $('#malcontent').val('');
      $('#icon').val('');
    
});



$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
     var formData = new FormData(this);
    var action_url = '';
    var utype = $("#usertypeid").val();
    if($('#action').val() == 'Add')
    {    
      if(utype==4){
          action_url = "{{ route('webadmin.deptintrostore') }}";
        }else if(utype==3){
          action_url = "{{ route('siteadmin.deptintrostore') }}";
        }else if(utype==5){
          action_url = "{{ route('editor.deptintrostore') }}";
        }
    }
        

    if($('#action').val() == 'Edit')
    {      
      if(utype==4){
          action_url = "{{ route('webadmin.deptintroupdate') }}";
        }else if(utype==3){
          action_url = "{{ route('siteadmin.deptintroupdate') }}";
        }else if(utype==5){
          action_url = "{{ route('editor.deptintroupdate') }}";
        }
      }
        

    $.ajax({
         url: action_url,
         method:"post",
         data:formData,
         cache:false,
         contentType: false,
         processData: false,
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
  });


  $(document).on('click', '.edit', function(){
      var id = $(this).attr('id'); 
      var utype = $("#usertypeid").val();
      var action_url1='';
      if(utype==4){
        action_url1 = "/webadmin/deptintroedit/"+id;
      
        } else if(utype==3){
          
            action_url1 = "/siteadmin/deptintroedit/"+id;
        } else if(utype==5){
          
            action_url1 = "/editor/deptintroedit/"+id;
        }
      $('#ajaxformresults').html('');
      $.ajax({
       url :action_url1,
       dataType:"json",
       success:function(data)
        { 
          if(data.error){
            alert("The About department is Locked, So cannot be edited!");
          } else {         
          $("#uploadedimage1").attr('src',"{{asset('Departmentuser')}}/"+data.resultdata.file1);
           $("#uploadedimage2").attr('src',"{{asset('Departmentuser')}}/"+data.resultdata.file2);  
          $('#name1').val(data.resultdata.enuser1);
          $('#name2').val(data.resultdata.enuser2);
          $('#malname1').val(data.resultdata.maluser1);
          $('#malname2').val(data.resultdata.maluser2);
          $('#alttext1').val(data.resultdata.alt1);
          $('#alttext2').val(data.resultdata.alt2);
          $('#desgn1').val(data.resultdata.endesg1);
          $('#desgn2').val(data.resultdata.endesg2);
          $('#maldesgn1').val(data.resultdata.maldesg1);
          $('#maldesgn2').val(data.resultdata.maldesg2);
          $('#entooltip').val(data.resultdata.entooltip);
          $('#maltooltip').val(data.resultdata.maltooltip);
          $('#entitle').val(data.resultdata.entitle);
          $('#maltitle').val(data.resultdata.maltitle);
          $('#ensubtitle').val(data.resultdata.ensubtitle);
          $('#malsubtitle').val(data.resultdata.malsubtitle); 
          //$('#enbrief').val(data.resultdata.enbrief); 
          $('#enbrief').summernote('code', data.resultdata.enbrief);
          //$('#malbrief').val(data.resultdata.malbrief); 
          $('#malbrief').summernote('code', data.resultdata.malbrief);
          $('#encontent').summernote('code', data.resultdata.encontent);
          $('#malcontent').summernote('code', data.resultdata.malcontent);
          //$('#encontent').val(data.resultdata.encontent);
          //$('#malcontent').val(data.resultdata.encontent);
          
           if(data.resultdata.homepagestatus==1){
            $('#homepagestatus').prop('checked', true);
          } else {
            $('#homepagestatus').prop('checked', false);
          }
          
         
          $('#hidden_id1').val(id);
          $('.modal-title').text('Edit Details');
          $('#actionbutton1').val('Update Details');
          $('#action1').val('Edit');
          $('#transactionmodal').modal('show');
        }
      }
      })
  });

   $(document).on('click', '.active', function(){

    var id = $(this).attr('id'); 
    var utype = $("#usertypeid").val();
    var action_url2='';
    if(utype==4){
      action_url2 = "/webadmin/deptintrostatus/"+id;
    
      } else if(utype==3){
        
          action_url2 = "/siteadmin/deptintrostatus/"+id;
      } else if(utype==3){
        
          action_url2 = "/editor/deptintrostatus/"+id;
      }
    $.ajax({
      url:action_url2,
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
var utype = $("#usertypeid").val();
    var action_url3='';
    if(utype==4){
      action_url3 = "/webadmin/deptintrodestroy/"+element_id;
    
      } else if(utype==3){
        
          action_url3 = "/siteadmin/deptintrodestroy/"+element_id;
      } else if(utype==3){
        
          action_url3 = "/editor/deptintrodestroy/"+element_id;
      }
    $.ajax({
            url:action_url3,
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