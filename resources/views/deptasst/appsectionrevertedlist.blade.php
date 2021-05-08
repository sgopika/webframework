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
                <th>Name in Malayalam</th>
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
                    <td><span class="eng_xxxxs"> {{ $res->ensectionname }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->malsectionname }}</span> </td>
                  <td> <a type="button" class="active" name="statusbtn" id="{{ $res->id }}">@if($res->status==1)  <i class="fas fa-check-circle"></i>  @else <i class="fas fa-window-close fg-darkTaupe"></i> @endif</a></td>
                  <td>
                  <div class="btn-group" role="group" aria-label="Actionbuttons">
                <button type="button" class="edit btn btn-sm bg-lightBrown fg-darkCrimson eng_xxxxs " name="edit" id="{{ $res->id }}" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="fas fa-pencil-alt"></i>&nbsp;Edit</button>
                
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
      <form id="ajaxmodalform" method="post" class="form-horizontal">
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
           <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">App Department </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Select the app department.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <select class="form-control customform eng_xxxs fg-darkCrimson" id="appdepartments_id" name="appdepartments_id">
            <option>Select App Department</option>
                     </select>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Section Name </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the name.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="ensectionname" name="ensectionname" aria-describedby="HELPNAME" placeholder="Placeholder value" maxlength="50" minlength="3">
          <p id="ensectionnameerror" style="display:none; color:#FF0000;" >Only A -Z a-z 0-9 Characters and spaces are allowed.</p>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
 <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Section Name in Malayalam</label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the malayalam name.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malsectionname" name="malsectionname" aria-describedby="HELPNAME" placeholder="Placeholder value" maxlength="50" minlength="3">
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
     <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Section Details </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the name.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="ensectiondetails" name="ensectiondetails" aria-describedby="HELPNAME" placeholder="Placeholder value" maxlength="1000" minlength="3"></textarea>
          <p id="ensectiondetailserror" style="display:none; color:#FF0000;" >Only A -Z a-z 0-9 Characters and spaces are allowed.</p>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
 <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Section Details in Malayalam</label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the malayalam name.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malsectiondetails" name="malsectiondetails" aria-describedby="HELPNAME" placeholder="Placeholder value" maxlength="1000" minlength="3"></textarea>
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
 
/**/
  $('#ensectionname').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z \s]+$');
  if (!tested.test(testval))
  {
    $('#ensectionname').val('');
    
     $('#ensectionnameerror').slideDown("slow");

  }
  else
  {
     $('#ensectionnameerror').hide();
     
  }
      
});

  $('#ensectiondetails').on('change ', function(e) {
  var testval = this.value;
  var tested = new RegExp('^[a-zA-Z \s]+$');
  if (!tested.test(testval))
  {
    $('#ensectiondetails').val('');
    
     $('#ensectiondetailserror').slideDown("slow");

  }
  else
  {
     $('#ensectiondetailserror').hide();
     
  }
      
});




$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
	var usertype=$("#usertypeid").val(); 
	var actionurl1 = '';
  if($('#action').val() == 'Edit'){
    if(usertype==4){
    action_url1 = "{{ route('webadmin.appsectionupdate') }}";
  } else if(usertype==15){
    action_url1 = "{{ route('deptasst.appsectionupdate') }}";
  }
    
  }
	
    

    $.ajax({
         url: action_url1,
         method:"post",
         data:$(this).serialize(),
         dataType:"json",
         success:function(data)
         { 
            var html = '';
            if(data.errors)
            {
               alert("Already an App Section with same name exists");
               
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
	  var usertype=$("#usertypeid").val(); 
		var actionurl2 = '';
		
			 action_url2 = "/deptasst/appsectionedit/"+id;
      $('#ajaxformresults').html('');
      $.ajax({
       url :action_url2,
       dataType:"json",
       success:function(data)
        { 
           
          $('#ensectionname').val(data.resultdata.ensectionname);
          $('#malsectionname').val(data.resultdata.malsectionname);
           $('#ensectiondetails').val(data.resultdata.ensectiondetails);
            $('#malsectiondetails').val(data.resultdata.malsectiondetails);
          
           $('#appdepartments_id').empty();
            $('#appdepartments_id').append($('<option></option>').val('0').html('Select'));
            $.each(data.appdepartment, function(index, element) {
                $('#appdepartments_id').append(
                    $('<option></option>').val(element.id).html(element.entitle)
                );
                element.id == data.resultdata.appdepartments_id ? $('#appdepartments_id').val(element.id).prop('selected', true) : '';
            });
            
         
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Details');
          $('#actionbutton').val('Update Details');
          $('#action').val('Edit');
          $('#transactionmodal').modal('show');
        
        }
      })
  });

  var element_id;




$( ".close1" ).click(function() {
      $('#transactionmodal').modal('hide');
        
 });

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection