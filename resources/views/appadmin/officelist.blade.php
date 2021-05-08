@extends('layouts.basemain')
@section('content')
<!-- Start of breadcrumb -->

<!-- End of breadcrumb -->
<div class="container-fluid homepage adminpage">
<div class="row ">
  <div class="col-12 py-2  ">
    <nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
      <ol class="breadcrumb justify-content-end px-3 pt-2">
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('appadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      </ol>
      
    </nav>
  </div> <!-- col12 -->
  <div class="col-12 py-1 px-2 ">
    <p class="eng_xxs px-3 fg-darkBrown"> Office List </p>
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
     <!-- Button trigger modal -->

  </div> <!-- ./col12 -->
  <div class="col-12 py-1">
    <div class="responsive">
          <table class="table table-stripped table-sm table-hover box-shadow--6dp" id="resposivetable">
            <thead class="eng_xxxs thlist">
              <tr class="bg-teal">
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone / Email</th>
                <th>Map</th>
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
                    <td><span class="eng_xxxxs"> {{ $res->enaddress }} <hr class="py-1"> {{ $res->maladdress }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->phonenumbers }} <hr class="py-1"> {{ $res->email }}</span> </td>
                    <td><iframe src=" {{  $res->map }} " class="pt-3" width="150" height="100" frameborder="0" style="border:0;" allowfullscreen=""></iframe> </td>
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
      <form action="{{ route('appadmin.officestore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Image </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="file"  id="image" name="image" required>
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
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname" name="malname" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                <p id="malnameerror" style="display:none; color:#FF0000;" >Only malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Address</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enaddress" name="enaddress"></textarea>
                <p id="addresserror" style="display:none; color:#FF0000;">Allowed Characters are A-Z a-z 0-9 comma(,) hiphen(-) slash( / ) brackets( () ).</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Address in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="maladdress" name="maladdress"></textarea>
                <p id="maladdresserror" style="display:none; color:#FF0000;">Allowed Characters are malayalam Characters 0-9 comma(,) hiphen(-) slash( / ) brackets( () ).</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Phone Numbers</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="phonenumbers" name="phonenumbers"></textarea>
                <p id="phonenumberserror" style="display:none; color:#FF0000;">Allowed Characters are  0-9 comma(,) spaces.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Email ID</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="email" id="email" name="email" maxlength="100" minlength="10" class="form-control" >
                <p id="emailerror" style="display:none; color:#FF0000;" >
                 Invalid Email ID
                  </p>
                
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Map</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" name="map" id="map" value="" class="form-control btn-point" maxlength="200"  minlength="5" required>
           <p id="maperror" style="display:none; color:#FF0000;">Invalid Characters</p>
                
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
      <form action="{{ route('appadmin.officeupdate') }}" id="ajaxmodalform1" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Image </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <img src="" class="img-thumbnail displaythumbnail customform eng_xxxs fg-darkCrimson" alt="Image" id="uploadedimage">
                <input type="file"  id="image1" name="image1" >
                  <p id="imageerror2" style="display:none; color:#FF0000;">
                  Allowed Image Formats: .jpg, .png, .jpeg 
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
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="name1" name="name1" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="nameerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname1" name="malname1" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3">
                <p id="malnameerror1" style="display:none; color:#FF0000;" >Only malayalam Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Address</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enaddress1" name="enaddress1"></textarea>
                <p id="addresserror1" style="display:none; color:#FF0000;">Allowed Characters are A-Z a-z 0-9 comma(,) hiphen(-) slash( / ) brackets( () ).</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Address in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="maladdress1" name="maladdress1"></textarea>
                <p id="maladdresserror1" style="display:none; color:#FF0000;">Allowed Characters are malayalam Characters 0-9 comma(,) hiphen(-) slash( / ) brackets( () ).</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Phone Numbers</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="phonenumbers1" name="phonenumbers1"></textarea>
                <p id="phonenumberserror1" style="display:none; color:#FF0000;">Allowed Characters are  0-9 comma(,) spaces.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Email ID</label>
              
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
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Map</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" name="map1" id="map1" value="" class="form-control customform eng_xxxs fg-darkCrimson" maxlength="250"  minlength="5" >
           <p id="maperror1" style="display:none; color:#FF0000;">Invalid Characters</p>
                
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

$('#enaddress').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9-,/() \s]+$');
  if (!tested.test(testval))
  {
    $('#enaddress').val('');
    $('#addresserror').slideDown("slow");

  }
  else
  {
    $('#addresserror').hide();
    
  }
      
});

$('#enaddress1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9-,/() \s]+$');
  if (!tested.test(testval))
  {
    $('#enaddress1').val('');
    $('#addresserror1').slideDown("slow");

  }
  else
  {
    $('#addresserror1').hide();
    
  }
      
});

$('#maladdress').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _0-9-,/() \s]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#maladdresserror').hide();
}
else{
 // console.log("not Valid");
$('#maladdress').val('');
  $('#maladdresserror').slideDown("slow");
}
      
});


$('#maladdress1').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _0-9-,/() \s]+$");
if (XRegExp.test(testval, pattern)) {
   // console.log("Valid");
    $('#maladdresserror1').hide();
}
else{
 // console.log("not Valid");
$('#maladdress1').val('');
  $('#maladdresserror1').slideDown("slow");
}
      
});


$('#phonenumbers').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[0-9, \s]+$');
  if (!tested.test(testval))
  {
    $('#phonenumbers').val('');
    $('#phonenumberserror').slideDown("slow");

  }
  else
  {
    $('#phonenumberserror').hide();
    
  }
      
});

$('#phonenumbers1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[0-9, \s]+$');
  if (!tested.test(testval))
  {
    $('#phonenumbers1').val('');
    $('#phonenumberserror1').slideDown("slow");

  }
  else
  {
    $('#phonenumberserror1').hide();
    
  }
      
});

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

$('#map').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9:.?/=!% \s]+$');
  if (!tested.test(testval))
  {
    $('#map').val('');
    $('#maperror').slideDown("slow");

  }
  else
  {
    $('#maperror').hide();
    
  }
      
});

$('#map1').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9:.?/=!% \s]+$');
  if (!tested.test(testval))
  {
    $('#map1').val('');
    $('#maperror1').slideDown("slow");

  }
  else
  {
    $('#maperror1').hide();
    
  }
      
});

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
    $('.modal-title').text('Add New Office');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');

    $('#name').val('');
    $('#malname').val('');
    
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
      $.ajax({
       url :"/appadmin/officeedit/"+id,
       dataType:"json",
       success:function(data)
        { 
                  
          $("#uploadedimage").attr('src',"{{asset('Office')}}/"+data.resultdata.file);  
          $('#name1').val(data.resultdata.entitle);
		  $('#alttext1').val(data.resultdata.alt); 
          $('#malname1').val(data.resultdata.maltitle);
          $('#enaddress1').val(data.resultdata.enaddress);
          $('#maladdress1').val(data.resultdata.maladdress);
          $('#phonenumbers1').val(data.resultdata.phonenumbers);
          $('#email1').val(data.resultdata.email);
          $('#map1').val(data.resultdata.map);
          
          
         
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
    $.ajax({
      url:"/appadmin/officestatus/"+id,
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

    $.ajax({
            url:"/appadmin/officedestroy/"+element_id,
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
  ////////////////////////////////////////////////////////////////////////
  var val2=document.getElementById("maladdress1").value;

  if(val2!='')
  { //alert(val);
    //var alphaExp = /^[a-zA-Z0-9\/\,\.\-\(\)\&\@\#\$\%\^\*\+\=\{\}\<\>\;\'\"]+$/;
    var tested2 = new RegExp("[^a-zA-Z;:'<>]+$");
    if (!tested2.test(val2)){
      //alert("Please enter Allegation Name in malayalam");
      document.getElementById("maladdress1").value="";
      document.getElementById("maladdress1").focus();
      document.getElementById("maladdresserror1").style.display = 'block';
      return false;
    } else{
      //document.getElementById("malnameerror").hide();

    // hide the lorem ipsum text
    document.getElementById("maladdresserror1").style.display = 'none';
    }

  }
  ////////////////////////////////////////////////////////////////////
  var val3=document.getElementById("maladdress").value;

  if(val3!='')
  { //alert(val);
    //var alphaExp = /^[a-zA-Z0-9\/\,\.\-\(\)\&\@\#\$\%\^\*\+\=\{\}\<\>\;\'\"]+$/;
    var tested3 = new RegExp("[^a-zA-Z;:'<>]+$");
    if (!tested3.test(val3)){
      //alert("Please enter Allegation Name in malayalam");
      document.getElementById("maladdress").value="";
      document.getElementById("maladdress").focus();
      document.getElementById("maladdresserror").style.display = 'block';
      return false;
    } else{
      //document.getElementById("malnameerror").hide();

    // hide the lorem ipsum text
    document.getElementById("maladdresserror").style.display = 'none';
    }

  }
}

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection