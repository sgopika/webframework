@extends('layouts.basemain')
@section('content')
<!-- Start of breadcrumb -->

<!-- End of breadcrumb -->
<div class="container-fluid homepage adminpage">
<div class="row ">
  <div class="col-12 py-2  ">
    <nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
      <ol class="breadcrumb justify-content-end px-3 pt-2">
          
        <li class="breadcrumb-item"><a class="no_link" href="{{ route('moderatorhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
         <li class="breadcrumb-item"><a class="no_link" href="{{ route('moderator.contributeditems', $val) }}"> Items</a></li>
         
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
                @if($val==1)<th>Action</th>@else <th></th>@endif
              </tr>
            </thead>
            <tbody class="eng_xxxs">
               @php
                $i=1
                @endphp

                @foreach($listdata as $res)

                <tr>
                    <td><span class="eng_xxxxs"> {{ $i }} </span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->entitle }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->maltitle }}</span> </td>
                  <td><span class="active" id="{{ $res->id }}"> @if($res->status==1)<i class="fas fa-check-square"></i>@elseif($res->status==2)  <i class="fas fa-window-close fg-darkTaupe"></i>@endif </span></td>
                  @if($val==1)<td>
                  <div class="btn-group" role="group" aria-label="Actionbuttons">
              
              <button type="button" class="edit btn btn-sm bg-lightBrown fg-darkCrimson eng_xxxxs verify" name="verify" id="{{ $res->id }}" data-toggle="tooltip" data-placement="top" title="Verify"> <i class="fas fa-pencil-alt"></i>&nbsp;Verify</button>&nbsp; &nbsp;
              <button type="button" class="btn btn-sm bg-lightBrown fg-darkCrimson eng_xxxxs reject" name="reject" id="{{ $res->id }}" data-toggle="tooltip" data-placement="top" title="Reject"> <i class="fas fa-reply"></i>&nbsp;Reject</button>
              
            </div>
                  </td>
                  @else
                  <td>
                    @if($res->moderator_status==2 && $res->approve_status==0)
                    <span class=" badge bg-warning text-white"> Not Viewed </span>
                    @elseif($res->moderator_status==3 && $res->approve_status==0)
                    <span class=" badge bg-danger text-white"> Reverted</span>
                    @elseif($res->approve_status==1)
                      <span class=" badge bg-info text-white"> Viewed </span>
                    @elseif($res->approve_status==2)
                      <span class="badge bg-success text-white"> Published </span>
                    @endif
                  </td>
                  @endif
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
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header modalover">
        <p class="modal-title eng_xxs fg-darkEmerald" id="addmodalLabel"><i class="fab fa-wpforms"></i>&nbsp;Modal title</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- ./modal-header -->
      <form id="ajaxmodalform" method="post" class="form-horizontal">
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Remarks </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="moderator_remarks" name="moderator_remarks" aria-describedby="HELPNAME" placeholder="Placeholder value"></textarea>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    
    

    </div> <!-- ./form_section -->

      </div> <!-- ./modal-body -->
      <div class="modal-footer modalover">
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="status_id" id="status_id" />
        <button type="submit" class="btn btn-sm btn-flat eng_xxxs fg-grayWhite bg-darkMagenta"> <i class="fas fa-save"></i> &nbsp;Save changes</button>

      </div> <!-- ./modal-footer  -->
    </form>
    </div> <!-- ./modal-content -->
  </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->


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
      var id = $(this).attr('id'); 
      
      $.ajax({
       url :"/moderator/contributedabtdeptverify/"+id,
       dataType:"json",
       success:function(data)
        { 
          $('#status_id').val(1);
          $('#hidden_id').val(id);
          $('.modal-title').text('Add Remarks');
          $('#actionbutton').val('Verify');
          $('#transactionmodal').modal('show');
          /* if(data.error)
          {
            //alert("Already an active Alert exists!!!");
            
          }
          if(data.success)
          { 
            window.location.reload();

          }  */        
            
          
        }
      })
});

$(document).on('click', '.reject', function(){
      var id = $(this).attr('id'); 
      
      $.ajax({
       url :"/moderator/contributedabtdeptverify/"+id,
       dataType:"json",
       success:function(data)
        { 
          $('#status_id').val(2);
          $('#hidden_id').val(id);
          $('.modal-title').text('Add Remarks');
          $('#actionbutton').val('Reject');
          $('#transactionmodal').modal('show');
          /* if(data.error)
          {
            //alert("Already an active Alert exists!!!");
            
          }
          if(data.success)
          { 
            window.location.reload();

          }  */        
            
          
        }
      })
});

$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
    

    $.ajax({
         url: "{{ route('moderator.contributedabtdeptupdate') }}",
         method:"post",
         data:$(this).serialize(),
         dataType:"json",
         success:function(data)
         { 
            var html = '';
            
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
 

  

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection