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
    <p class="eng_xxs px-3 fg-darkBrown"> Membership Request List </p>
  </div> <!-- ./col12 -->
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
      <form id="ajaxmodalform" method="post" class="form-horizontal">
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


$("#mobile").keypress(function(e){
  var keyCode = e.which;
  if(keyCode == 69 || keyCode == 101)
  {
    e.preventDefault();
     $("#mobile").val('');
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


$("#transactionbutton").click(function(event){
    event.preventDefault();
    $('.modal-title').text('Add New Membership Request');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');

    $.ajax({
       url: "{{ route('appadmin.membershiprequestcreate') }}",
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

            $("#name").val('');
            $("#mobile").val('');
            $("#email").val('');
            
            $('.modal-title').text('Add New Membership Request');
            $('#actionbutton').val('Save Details');
            $('#action').val('Add');
            $('#ajaxformresults').html('');
            $("#transactionmodal").modal('show');
        }
       })
    
});



$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
    var action_url = '';
    if($('#action').val() == 'Add')
        action_url = "{{ route('appadmin.membershiprequeststore') }}";

    if($('#action').val() == 'Edit')
        action_url = "{{ route('appadmin.membershiprequestupdate') }}";

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
  });


  $(document).on('click', '.edit', function(){
      var id = $(this).attr('id'); 
      $('#ajaxformresults').html('');
      $.ajax({
       url :"/appadmin/membershiprequestedit/"+id,
       dataType:"json",
       success:function(data)
        { 
                    
            
          $('#departments_id').empty();
          $('#departments_id').append($('<option></option>').val('0').html('Select'));
          $.each(data.department, function(index, element) {
              $('#departments_id').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.departments_id ? $('#departments_id').val(element.id).prop('selected', true) : '';    
          });

          $('#designations_id').empty();
          $('#designations_id').append($('<option></option>').val('0').html('Select'));
          $.each(data.designation, function(index, element) {
              $('#designations_id').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.designations_id ? $('#designations_id').val(element.id).prop('selected', true) : '';     
          });
          
          $('#offices_id').empty();
          $('#offices_id').append($('<option></option>').val('0').html('Select'));
          $.each(data.office, function(index, element) {
              $('#offices_id').append(
                  $('<option></option>').val(element.id).html(element.entitle)
              );
          element.id == data.resultdata.offices_id ? $('#offices_id').val(element.id).prop('selected', true) : ''; 
          });

          $('#name').val(data.resultdata.name);
          $('#mobile').val(data.resultdata.mobile);
          $('#email').val(data.resultdata.email);
          
         
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Details');
          $('#actionbutton').val('Update Details');
          $('#action').val('Edit');
          $('#transactionmodal').modal('show');
        }
      })
  });

   $(document).on('click', '.active', function(){

    var id = $(this).attr('id'); 
    $.ajax({
      url:"/appadmin/membershiprequeststatus/"+id,
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
            url:"/appadmin/membershiprequestdestroy/"+element_id,
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