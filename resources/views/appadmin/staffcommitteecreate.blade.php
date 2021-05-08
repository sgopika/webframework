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
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('appadmin.staffcommitteelist') }}"> &nbsp;Staff Committees</a></li>
         @elseif(Auth::user()->usertypes_id==9)
          <li class="breadcrumb-item"><a class="no_link" href="{{ route('appmanagerhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('appmanager.staffcommitteelist') }}"> &nbsp;Staff Committees</a></li>
         @endif
        
      </ol>
      
    </nav>
  </div> <!-- col12 -->
 
  <div class="col-12 py-1 px-2 ">
    <p class="eng_xxs px-3 fg-darkBrown"> Create Staff Commitee </p>
  </div> <!-- ./col12 --> 
  <div class="col-12 md-whiteframe-2dp ">
     @if(Auth::user()->usertypes_id==2)
    <form action="{{ route('appadmin.staffcommitteestore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
     @elseif(Auth::user()->usertypes_id==9)
    <form action="{{ route('appmanager.staffcommitteestore') }}" id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
     @endif
    
        @csrf
    <div id="form_section">
    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Committee</label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
           <select class="form-control customform eng_xxxs fg-darkCrimson" id="committees_id" name="committees_id" required>
              <option value="">--SELECT--</option>
              @foreach($committee as $committeeres)
                <option value="{{ $committeeres->id }}">{{ $committeeres->entitle }}</option>
              @endforeach
            </select>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME1" class="eng_xxxs fg-darkBrown">Staffs</label>
        <small id="HELPNAME1" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
        @foreach($staff as $staffres)
          <input type="checkbox" id="staff" value="{{ $staffres->id }}" name="staff[]" >&nbsp; {{ $staffres->name }}<br>
        @endforeach  
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME2" class="eng_xxxs fg-darkBrown">Hierarchy </label>
        <small id="HELPNAME2" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
           <select class="form-control customform eng_xxxs fg-darkCrimson" id="hierarchies_id" name="hierarchies_id" required>
              <option value="">--SELECT--</option>
              @foreach($hierarchy as $hierarchyres)
                <option value="{{ $hierarchyres->id }}">{{ $hierarchyres->entitle }}</option>
              @endforeach
            </select>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2 justify-content-center d-flex">
        
        <button class="btn btn-sm btn-flat eng_xxxs bg-lightOrange fg-darkCrimson"> <i class="fas fa-broom"></i>&nbsp;Reset </button> &nbsp;&nbsp;
        </div>
        <div class="col-md-6 py-2 justify-content-center d-flex">
        
           <button class="btn btn-sm btn-flat eng_xxxs bg-darkAmber fg-lightGray px-3"> <i class="fas fa-save"></i>&nbsp;Save </button>
       
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    </div> <!-- ./form_section -->
  </form>
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


/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection