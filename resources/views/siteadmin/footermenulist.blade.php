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
         @endif
      </ol>
      
    </nav>
  </div> <!-- col12 -->
   <div class="col-12 py-1">
     <p class="py-2"> <strong > <i class="fas fa-hand-point-right"></i> &nbsp;Footermenu </strong></p>
   </div>
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
                <th>Malayalam Title</th>
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
                    <td><span class="eng_xxxxs"> {{ $res->entitle }}</span> </td>
                    <td><span class="eng_xxxxs"> {{ $res->maltitle }}</span> </td>
                    
                  <td> <a type="button" class="active" name="statusbtn" id="{{ $res->id }}">@if($res->status==1)  <i class="fas fa-check-circle"></i>  @else <i class="fas fa-window-close fg-darkTaupe"></i> @endif</a></td>
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
      <form id="ajaxmodalform" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">

         
          <div class="row customformrow">
      <div class="col-md-6 py-2">

        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Image </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Upload the file.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
         <img src="" class="img-thumbnail displaythumbnail customform eng_xxxs fg-darkCrimson" alt="Image" id="uploadedposter">
          <input type="file" class="form-control" id="filename" name="filename">
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
               <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Alternative Text.</small>
            </div> <!-- ./col-md-6 -->
            <div class="col-md-6 py-2">
                <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="alttext" name="alttext" aria-describedby="HELPNAME" placeholder="Name" maxlength="20" minlength="3">
                <p id="alttexterror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
            </div> <!-- ./col-md-6 -->
          </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Title </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the title.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="name" name="name" aria-describedby="HELPNAME" placeholder="Placeholder value">
          <p id="nameerror" style="display:none; color:#FF0000;" >Only A -Z a-z Characters are allowed.</p>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
<div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Malayalam title </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the Malayalam title.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <input type="text" class="form-control customform eng_xxxs fg-darkCrimson" id="malname" name="malname" aria-describedby="HELPNAME" placeholder="Placeholder value">
          <p id="malnameerror" style="display:none; color:#FF0000;" >Only Malayalam Characters are allowed.</p>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
<div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Footer Content </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the content.</small>
        <textarea id="summernoteeng" name="summernoteeng" class="form-control customform eng_xxxs fg-darkCrimson"></textarea>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">

    <label for="IDNAME" class="eng_xxxs fg-darkBrown">Malayalam Footer Content </label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> Enter the Malayalam content.</small>
         <textarea id="summernotemal" name="summernotemal" class="form-control customform eng_xxxs fg-darkCrimson"></textarea>
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


$('#filename').bind('change', function() {
    
    var ext = $('#logofile').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1){
      $('#imageerror').slideDown("slow");
      $('#imageerror1').slideUp("slow");
      $('#filename').val('');
     
    }else{
      var picsize = (this.files[0].size);
      if (picsize > 1000000){
        $('#imageerror1').slideDown("slow");
        $('#filename').val('');
     
      }else{
     
        $('#imageerror1').slideUp("slow");
      }
      $('#imageerror').slideUp("slow");
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


 $('#malname').on('change ', function(e) {
  var testval = this.value;
 
  var pattern = new XRegExp("^[\\p{InMalayalam} _.,]+$");
if (XRegExp.test(testval, pattern)) {
     $('#malnameerror').hide();
}
else{
$('#malname').val('');
  $('#malnameerror').slideDown("slow");
}
      
});

  

  $('#summernote').on('change ', function(e)
 {
    var testval = this.value;
    var tested = new RegExp('^[a-zA-Z-(),/. \s]+$');
    if (!tested.test(testval))
    {
      $('#summernote').val('');   
      $('#summernoteerror').slideDown("slow");

    }
    else
    {
       $('#summernoteerror').hide();
       
    }
}); 


$("#transactionbutton").click(function(event){
    event.preventDefault();
    $('.modal-title').text('Add New Footer');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');

    $('#filename').val(''); 
    $('#alttext').val('');
    $('#name').val(''); 
    $('#malname').val(''); 
    $('#subname').val('');
    $('#malsubname').val('');
    $('#iconclass').val('');
    
});



$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
    var formData = new FormData(this);

     var usertype=$("#usertypeid").val(); 
    var action_url = '';

  if(usertype==3){
    
      if($('#action').val() == 'Add')
        action_url = "{{ route('siteadmin.footermenustore') }}";

    if($('#action').val() == 'Edit')
        action_url = "{{ route('siteadmin.footermenustore') }}";

  } else if(usertype==4){

      if($('#action').val() == 'Add')
        action_url = "{{ route('webadmin.footermenustore') }}";

    if($('#action').val() == 'Edit')
        action_url = "{{ route('webadmin.footermenustore') }}";

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
               alert("Already an footer menu with same name exists");
               
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

      var action_url2 = '';
      var usertype=$("#usertypeid").val(); 
      if(usertype==3){
         action_url2 = "/siteadmin/footermenuedit/"+id;
      } else if(usertype==4){
         action_url2 = "/webadmin/footermenuedit/"+id;
      }
      $.ajax({
       url :action_url2,
       dataType:"json",
       success:function(data)
        { 
                    
            
        //  $('#filename').val(data.resultdata.file); 
        $("#uploadedposter").attr('src',"{{asset('Footermenu')}}/"+data.resultdata.file);
          $('#alttext').val(data.resultdata.alt); 
          $('#name').val(data.resultdata.entitle); 
          $('#malname').val(data.resultdata.maltitle);
          $('#summernoteeng').summernote('code',data.resultdata.encontent);
          $('#summernotemal').summernote('code',data.resultdata.malcontent);
                   
         
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
    var usertype=$("#usertypeid").val();
     var action_url3 = ''; 
      if(usertype==3){
         action_url3 = "/siteadmin/footermenustatus/"+id;
      } else if(usertype==4){
         action_url3 = "/webadmin/footermenustatus/"+id;
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

    $.ajax({
            url:"/siteadmin/footerdestroy/"+element_id,
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


$('#summernoteeng').summernote({
    tabsize: 2,
    height: 250,
    width: '100%',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
    ],
  });
$('#summernotemal').summernote({
    tabsize: 2,
    height: 250,
    width: '100%',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
    ],
  });
</script>
@endsection





