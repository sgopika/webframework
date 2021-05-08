@extends('layouts.basemain')
@section('content')
<!-- Start of breadcrumb -->

<!-- End of breadcrumb -->
<div class="container-fluid homepage adminpage">
<div class="row ">
  <div class="col-12 py-2  ">
    <nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
      <ol class="breadcrumb justify-content-end px-3 pt-2">
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptassthome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
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
    <div class="responsive">
        @if(isset($listdata))
          <form action="{{ route('deptasst.appdepartmentupdate') }}" id="ajaxmodalform" method="post" class="form-horizontal">
        @else
          <form action="{{ route('deptasst.appdepartmentstore') }}" id="ajaxmodalform" method="post" class="form-horizontal">
        @endif    
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
          
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="entitle" name="entitle" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3" value="@if(isset($listdata)) {{ $listdata->entitle }} @endif ">
                <input type="hidden" name="hidden_id" id="hidden_id" value="@if(isset($listdata)) {{ $listdata->id }} @endif ">
                <p id="nameerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Name in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="maltitle" name="maltitle" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="50" minlength="3" value="@if(isset($listdata)) {{ $listdata->maltitle }} @endif ">
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">About </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enabout" name="enabout" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->enabout }} @endif </textarea>
                <p id="enabouterror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">About in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malabout" name="malabout" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->malabout }} @endif </textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Structure </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enstructure" name="enstructure" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->enstructure }} @endif </textarea>
                <p id="enstructureerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Structure in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malstructure" name="malstructure" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->malstructure }} @endif </textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Contact </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="encontact" name="encontact" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->encontact }} @endif </textarea>
                <p id="encontacterror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Contact in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malcontact" name="malcontact" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->malcontact }} @endif </textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Related Links </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enrelatedlinks" name="enrelatedlinks" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->enrelatedlinks }} @endif </textarea>
                <p id="enrelatedlinkserror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Related Links in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malrelatedlinks" name="malrelatedlinks" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->malrelatedlinks }} @endif </textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Services </label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enservices" name="enservices" aria-describedby="HELPNAME" placeholder="Name" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->enservices }} @endif </textarea>
                <p id="enserviceserror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->
          <div class="row customformrow">
            <div class="col-md-6 py-2">
              <label for="IDNAME" class="eng_xxxs fg-darkBrown">Services in Malayalam</label>
              
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malservices" name="malservices" aria-describedby="HELPNAME" placeholder="Name in Malayalam" maxlength="1000" minlength="3">@if(isset($listdata)) {{ $listdata->malservices }} @endif </textarea>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->

        </div> <!-- ./form_section -->

      </div> <!-- ./modal-body -->
      <div class="modal-footer modalover">
        
        <button type="submit" class="btn btn-sm btn-flat eng_xxxs fg-grayWhite bg-darkMagenta btnsubmit"> <i class="fas fa-save"></i> &nbsp;@if(isset($listdata)) Update Changes @else Save changes @endif</button>

      </div> <!-- ./modal-footer  -->
    </form>
    </div>
  </div> <!-- ./col12 -->
</div> <!-- ./row -->
</div> <!-- ./container -->



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
 

  $('#entitle').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#entitle').val('');
    
     $('#nameerror').slideDown("slow");

  }
  else
  {
     $('#nameerror').hide();
     
  }
      
  });

  $('#enabout').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enabout').val('');
    
     $('#enabouterror').slideDown("slow");

  }
  else
  {
     $('#enabouterror').hide();
     
  }
      
});

  $('#enstructure').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enstructure').val('');
    
     $('#enstructureerror').slideDown("slow");

  }
  else
  {
     $('#enstructureerror').hide();
     
  }
      
});

  $('#encontact').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#encontact').val('');
    
     $('#encontacterror').slideDown("slow");

  }
  else
  {
     $('#encontacterror').hide();
     
  }
      
});


  $('#enrelatedlinks').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enrelatedlinks').val('');
    
     $('#enrelatedlinkserror').slideDown("slow");

  }
  else
  {
     $('#enrelatedlinkserror').hide();
     
  }
      
});

  $('#enservices').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z0-9 \s]+$');
  if (!tested.test(testval))
  {
    $('#enservices').val('');
    
     $('#enserviceserror').slideDown("slow");

  }
  else
  {
     $('#enserviceserror').hide();
     
  }
      
});

 
 


/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection