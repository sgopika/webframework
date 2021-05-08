@extends('layouts.basemain')
@section('content')
<!-- Start of breadcrumb -->

<!-- End of breadcrumb -->
<div class="container-fluid homepage adminpage">
<div class="row ">
  <div class="col-12 py-2  ">
    <nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
      <ol class="breadcrumb justify-content-end px-3 pt-2">
         
          @if(Auth::user()->usertypes_id==2)
        <li class="breadcrumb-item"><a class="no_link" href="{{ route('appadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         @elseif(Auth::user()->usertypes_id==9)
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('appmanagerhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         @endif
      </ol>
      
    </nav>
  </div> <!-- col12 -->
 
 <div class="col-12 py-1 px-2 ">
    <p class="eng_xxs px-3 fg-darkBrown"> Staff List </p>
  </div> <!-- ./col12 -->
  
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
                <th>Name</th>
                <th>Mobile / Email</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Office</th>
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
                    <td><span class="eng_xxxxs"> {{ $res->name }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->mobile }} <hr class="py-1">{{ $res->email }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->department }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->designation }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->office }}</span> </td>
                  <td><span class="active" id="{{ $res->id }}"> @if($res->status==1)<i class="fas fa-check-square"></i>@elseif($res->status==2)  <i class="fas fa-window-close fg-darkTaupe"></i>@endif </span></td>
                  <td>
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
     
          @if(Auth::user()->usertypes_id==2)
        <form action="{{ route('appadmin.staffstore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
         @elseif(Auth::user()->usertypes_id==9)
         <form action="{{ route('appmanager.staffstore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
         @endif
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="name" name="name" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="nameerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname" name="malname" aria-describedby="HELPNAME" placeholder="Name" maxlength="50" minlength="3">
                <p id="malnameerror" style="display:none; color:#FF0000;" >Only malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Department</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="departments_id" name="departments_id" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Designation</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="designations_id" name="designations_id" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Office</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="offices_id" name="offices_id" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Staff Category</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="staffcategories_id" name="staffcategories_id" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Hierarchy</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="hierarchies_id" name="hierarchies_id" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Email</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="email" id="email" name="email" maxlength="100" minlength="10" class="form-control customform eng_xxxs fg-darkCrimson" >
                <p id="emailerror" style="display:none; color:#FF0000;" >
                 Invalid Email ID
                  </p>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Mobile</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" id="mobile" name="mobile"  minlength="10" class="form-control customform eng_xxxs fg-darkCrimson" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required>
                <p id="mobilenumbererror" style="display:none; color:#FF0000;" class="mal_xxxs"> Invalid Mobile </p>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Join Date</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" name="joindate" id="joindate" value="{{ Carbon\Carbon::now()->format('d/m/Y')  }}" class="form-control customform eng_xxxs fg-darkCrimson dob" required>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Poster </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="file"  id="poster" name="poster" class="" required>
                  <p id="imageerror" style="display:none; color:#FF0000;">
                  Allowed Image Formats: .jpg, .png, .jpeg 
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
          @if(Auth::user()->usertypes_id==2)
        <form action="{{ route('appadmin.staffupdate') }}" id="ajaxmodalform1" method="post" class="form-horizontal" enctype="multipart/form-data">
         @elseif(Auth::user()->usertypes_id==9)
          <form action="{{ route('appmanager.staffupdate') }}" id="ajaxmodalform1" method="post" class="form-horizontal" enctype="multipart/form-data">
         @endif
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="name1" name="name1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3" required="">
                <p id="nameerror1" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname1" name="malname1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3" required="">
                <p id="malnameerror1" style="display:none; color:#FF0000;" >Only malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Department</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="departments_id1" name="departments_id1" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Designation</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="designations_id1" name="designations_id1" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Office</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="offices_id1" name="offices_id1" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Staff Category</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="staffcategories_id1" name="staffcategories_id1" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
           <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Hierarchy</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <select class="form-control customform eng_xxxs fg-darkCrimson" id="hierarchies_id1" name="hierarchies_id1" required>
                          <option value="">--SELECT--</option>
                        </select>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Email</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="email" id="email1" name="email1" maxlength="100" minlength="10" class="form-control customform eng_xxxs fg-darkCrimson" >
                <p id="emailerror1" style="display:none; color:#FF0000;" >
                 Invalid Email ID
                  </p>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Mobile</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" id="mobile1" name="mobile1"  minlength="10" class="form-control customform eng_xxxs fg-darkCrimson" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required>
                <p id="mobilenumbererror1" style="display:none; color:#FF0000;" class="mal_xxxs"> Invalid Mobile </p>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Join Date</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                 <input type="text" name="joindate1" id="joindate1" value="" class="form-control customform eng_xxxs fg-darkCrimson dob" required>

            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Poster </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <img src="" class="img-thumbnail displaythumbnail customform eng_xxxs fg-darkCrimson" alt="Image" id="uploadedposter">
                <input type="file"  id="poster1" name="poster1" class="">
                  <p id="postererror2" style="display:none; color:#FF0000;">
                  Allowed Image Formats: .jpg, .png, .jpeg 
                  </p>
                  <p id="postererror3" style="display:none; color:#FF0000;" class="mal_xxxs">
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

  $('.dob').inputmask("date",{
    mask: "1/2/y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "/",
    alias: "dd/mm/yyyy"
  });
 

  $('#name').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z \s]+$');
  if (!tested.test(testval))
  {
    $('#name').val('');
    
     $('#nameerror').slideDown("slow");

  }
  else
  {
     $('#nameerror').hide();
     
  }
      
});


  $('#name1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z \s]+$');
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

 $('#malname').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#malnameerror').hide();
}
else{
 // console.log("not Valid");
$('#malname').val('');
  $('#malnameerror').slideDown("slow");
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

$('#mobile').on('change ', function() {
  $('#mobilenumbererror').hide();
    var mobile = $("#mobile").val();
    var tested = new RegExp('^[0-9]+$');
   
      if(mobile.length!=10 || !tested.test(mobile)){
        $("#mobile").val('');
        $('#mobilenumbererror').slideDown("slow");
        
      } else {
        $('#mobilenumbererror').hide();
      }
});

$('#mobile1').on('change ', function() {
  $('#mobilenumbererror1').hide();
    var mobile = $("#mobile1").val();
    var tested = new RegExp('^[0-9]+$');
   
      if(mobile.length!=10 || !tested.test(mobile)){
        $("#mobile1").val('');
        $('#mobilenumbererror1').slideDown("slow");
        
      } else {
        $('#mobilenumbererror1').hide();
      }
});


$("#mobile").keypress(function(e){
  var keyCode = e.which;
  if(keyCode == 69 || keyCode == 101)
  {
    e.preventDefault();
     $("#mobile").val('');
  }
  })

$("#mobile1").keypress(function(e){
  var keyCode = e.which;
  if(keyCode == 69 || keyCode == 101)
  {
    e.preventDefault();
     $("#mobile1").val('');
  }
  })

$('#email').on('change ', function(e) {
  var testval = this.value;
  if(testval != '')
  {
    var tested = new RegExp('^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$');
    if (!tested.test(testval))
    {
      $('#email').val('');
      $('#emailerror').slideDown("slow");
      
    }
    else
    {
       $('#emailerror').hide();
       
    }
 }
});

$('#email1').on('change ', function(e) {
  var testval = this.value;
  if(testval != '')
  {
    var tested = new RegExp('^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$');
    if (!tested.test(testval))
    {
      $('#email1').val('');
      $('#emailerror1').slideDown("slow");
      
    }
    else
    {
       $('#emailerror1').hide();
       
    }
 }
});
$('#poster').bind('change', function() {
    
    var ext = $('#poster').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#postererror').slideDown("slow");
      $('#postererror1').slideUp("slow");
      $('#poster').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#postererror1').slideDown("slow");
        $('#poster').val('');
     
      }else{
     
        $('#postererror1').slideUp("slow");
      }
      $('#postererror').slideUp("slow");
    }
  });

 $('#poster1').bind('change', function() {
    
    var ext = $('#poster1').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#postererror2').slideDown("slow");
      $('#postererror3').slideUp("slow");
      $('#poster1').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#postererror3').slideDown("slow");
        $('#poster1').val('');
     
      }else{
     
        $('#postererror3').slideUp("slow");
      }
      $('#postererror2').slideUp("slow");
    }
  });

 $('#alttext').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z \s]+$');
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
  var tested = new RegExp('^[a-zA-Z \s]+$');
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

$("#transactionbutton").click(function(event){
    event.preventDefault();
    $('.modal-title').text('Add New Staff');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');
     var usertype=$("#usertypeid").val(); 
      var action_url = '';
      if(usertype==2){
         action_url = "{{ route('appadmin.staffcreate') }}";
      } else if(usertype==9){
         action_url = "{{ route('appmanager.staffcreate') }}";
      } 

    $.ajax({
       url:action_url ,
       dataType:"json",
       success:function(data)
        {
            $('#departments_id').empty();
            $('#departments_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.department, function(index, element) {
                $('#departments_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });

            $('#designations_id').empty();
            $('#designations_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.designation, function(index, element) {
                $('#designations_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });

            $('#offices_id').empty();
            $('#offices_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.office, function(index, element) {
                $('#offices_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });

            $('#staffcategories_id').empty();
            $('#staffcategories_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.staffcategory, function(index, element) {
                $('#staffcategories_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });

            $('#hierarchies_id').empty();
            $('#hierarchies_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.hierarchy, function(index, element) {
                $('#hierarchies_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
            });

            $("#name").val('');
            $("#mobile").val('');
            $("#email").val('');
            
            $('.modal-title').text('Add New Staff');
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
        action_url = "{{ route('appadmin.staffstore') }}";

    if($('#action').val() == 'Edit')
        action_url = "{{ route('appadmin.staffupdate') }}";

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
               alert("Already a Staff with same name exists");
               
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
      if(usertype==2){
         action_url2 = "/appadmin/staffedit/"+id;
      } else if(usertype==9){
         action_url2 = "/appmanager/staffedit/"+id;
      } 
      $.ajax({
       url :action_url2,
       dataType:"json",
       success:function(data)
        { 
                    
            
          $('#departments_id1').empty();
          $('#departments_id1').append($('<option></option>').val('0').html('Select'));
          $.each(data.department, function(index, element) {
              $('#departments_id1').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.departments_id ? $('#departments_id1').val(element.id).prop('selected', true) : '';    
          });

          $('#designations_id1').empty();
          $('#designations_id1').append($('<option></option>').val('0').html('Select'));
          $.each(data.designation, function(index, element) {
              $('#designations_id1').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.designations_id ? $('#designations_id1').val(element.id).prop('selected', true) : '';     
          });
          
          $('#offices_id1').empty();
          $('#offices_id1').append($('<option></option>').val('0').html('Select'));
          $.each(data.office, function(index, element) {
              $('#offices_id1').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.offices_id ? $('#offices_id1').val(element.id).prop('selected', true) : ''; 
          });

          $('#staffcategories_id1').empty();
          $('#staffcategories_id1').append($('<option></option>').val('0').html('Select'));
          $.each(data.staffcategory, function(index, element) {
              $('#staffcategories_id1').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.staffcategories_id ? $('#staffcategories_id1').val(element.id).prop('selected', true) : ''; 
          });

          $('#hierarchies_id1').empty();
          $('#hierarchies_id1').append($('<option></option>').val('0').html('Select'));
          $.each(data.hierarchy, function(index, element) {
              $('#hierarchies_id1').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.hierarchies_id ? $('#hierarchies_id1').val(element.id).prop('selected', true) : ''; 
          });

          $('#name1').val(data.resultdata.name);
          $('#malname1').val(data.resultdata.malname);
          $('#mobile1').val(data.resultdata.mobile);
          $('#email1').val(data.resultdata.email);
          $('#alttext1').val(data.resultdata.alt);
          $("#uploadedposter").attr('src',"{{asset('Staff')}}/"+data.resultdata.poster);
         
          var start = new Date(data.resultdata.joindate);
          var dd = start.getDate();
          var mm = start.getMonth()+1; //January is 0! 
          var yyyy = start.getFullYear();
          if(dd<10){dd='0'+dd};
          if(mm<10){mm='0'+mm};
          var start = dd+'/'+mm+'/'+yyyy; 
          $('#joindate1').val(start);

          $('#hidden_id1').val(id);
          $('.modal-title').text('Edit Details');
          $('#actionbutton1').val('Update Details');
          $('#action1').val('Edit');
          $('#transactionmodal1').modal('show');
        }
      })
  });

   $(document).on('click', '.active', function(){

    var id = $(this).attr('id'); 
    var usertype=$("#usertypeid").val(); 
      var action_url3 = '';
      if(usertype==2){
         action_url3 = "/appadmin/staffstatus/"+id;
      } else if(usertype==9){
         action_url3 ="/appmanager/staffstatus/"+id;
      } 
    $.ajax({
      url: action_url3,
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
      if(usertype==2){
         action_url4 = "/appadmin/staffdestroy/"+element_id;
      } else if(usertype==9){
         action_url4 ="/appmanager/staffdestroy/"+element_id;
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

function malyalam_check(){
  var val=document.getElementById("malname").value;

  if(val!='')
  { //alert(val);
    //var alphaExp = /^[a-zA-Z0-9\/\,\.\-\(\)\&\@\#\$\%\^\*\+\=\{\}\<\>\;\'\"]+$/;
    var tested = new RegExp("[^a-zA-Z0-9/.,;:'<>]+$");
    if (!tested.test(val)){
      //alert("Please enter Allegation Name in malayalam");
      document.getElementById("malname").value="";
      document.getElementById("malname").focus();
      document.getElementById("malnameerror").style.display = 'block';
      return false;
    } else{
      //document.getElementById("malnameerror").hide();

    // hide the lorem ipsum text
    document.getElementById("malnameerror").style.display = 'none';
    }

  }

  var val1=document.getElementById("malname1").value;

  if(val1!='')
  { //alert(val);
    //var alphaExp = /^[a-zA-Z0-9\/\,\.\-\(\)\&\@\#\$\%\^\*\+\=\{\}\<\>\;\'\"]+$/;
    var tested1 = new RegExp("[^a-zA-Z0-9/.,;:'<>]+$");
    if (!tested1.test(val1)){
      //alert("Please enter Allegation Name in malayalam");
      document.getElementById("malname1").value="";
      document.getElementById("malname1").focus();
      document.getElementById("malnameerror1").style.display = 'block';
      return false;
    } else{
      //document.getElementById("malnameerror").hide();

    // hide the lorem ipsum text
    document.getElementById("malnameerror1").style.display = 'none';
    }

  }
}

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection