@extends('layouts.basemain')
@section('content')
<!-- Start of breadcrumb -->

<!-- End of breadcrumb -->
<div class="container-fluid homepage adminpage">
<div class="row ">
  <div class="col-12 py-2  ">
    <nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
      <ol class="breadcrumb justify-content-end px-3 pt-2">
          @if(Auth::user()->usertypes_id==14)
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptheadhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('depthead.appsection') }}">App Section</a></li>
          @elseif(Auth::user()->usertypes_id==16)
        <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptsohome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptso.appsection') }}">App Section</a></li>
         @endif
      </ol>
      
    </nav>
  </div> <!-- col12 -->
 
  
  <div class="col-12 py-1">
    <div class="responsive">
          <table class="table table-stripped table-sm table-hover box-shadow--6dp" id="resposivetable">
            <thead class="eng_xxxs thlist">
              <tr class="bg-teal">
                <th>#</th>
                <th>Name</th>
                <th>Name in Malayalam</th>
                <th>Status</th>
                <th>Approved time</th>
              </tr>
            </thead>
            <tbody class="eng_xxxs">
               @php
                $i=1
                @endphp
                @foreach($listdata as $res)

                <tr>
                    <td><span class="eng_xxxxs"> {{ $i }} </span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->ensectionname }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->malsectionname }}</span> </td>
                  <td><span class="active" id="{{ $res->id }}"> @if($res->status==1)<i class="fas fa-check-square"></i>@elseif($res->status==2)  <i class="fas fa-window-close fg-darkTaupe"></i>@endif </span></td>
                  <td><span class="eng_xxxxs"> {{ $res->moderator_timestamp }}</span>
                
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


$(document).on('click', '.verify', function(){
      var id = $(this).attr('id'); alert(id);
      
       $('#hidden_id').val(id);
          $('.modal-title').text('Add Remarks');
          $('#actionbutton').val('Verify');
          $('#transactionmodal').modal('show');
  });


  

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection