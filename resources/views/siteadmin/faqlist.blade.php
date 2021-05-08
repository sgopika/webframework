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
     <p class="py-2"> <strong > <i class="fas fa-hand-point-right"></i> &nbsp; FAQ List </strong></p>
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
                <th>Question</th>
                <th>Answer</th>
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
                    <td><span class="eng_xxxxs"> {{ $res->enquestion }}</span> </td>
                     <td><span class="eng_xxxxs"> {{ $res->enanswer }}</span> </td>
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
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header modalover">
        <p class="modal-title eng_xxs fg-darkEmerald" id="addmodalLabel"><i class="fab fa-wpforms"></i>&nbsp;Modal title</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- ./modal-header -->
       @if(Auth::user()->usertypes_id==3)
      <form id="ajaxmodalform" method="post" class="form-horizontal"  action="{{ route('siteadmin.faqstore') }}">
         @elseif(Auth::user()->usertypes_id==4)
        <form id="ajaxmodalform" method="post" class="form-horizontal"  action="{{ route('webadmin.faqstore') }}">
          @endif
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="faqcheck">
                            @if(old('faqcheck')!="")
                                <div id="countVar" data-count = "{{ count(old('faqcheck')) }}"></div>
                                @foreach(old('faqcheck') as $key => $value)
                                    <tr data-id={{ ($key == 0)?$key+1:$key }}>
                                        <th scope="row">{{ ($key == 0)?$key+1:$key }}</th>
                                        <td>

                                    <textarea class="form-control customform eng_xxxs fg-darkCrimson @error('faqcheck.'.$key.'.enquestion') is-invalid @enderror" name="faqcheck[{{$key}}][enquestion]" aria-describedby="HELPNAME" placeholder="English Question" maxlength="250" minlength="3"></textarea>&nbsp;
                                            @error('faqcheck.'.$key.'.enquestion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <!-- malayalam -->
                                             <textarea class="form-control customform eng_xxxs fg-darkCrimson @error('faqcheck.'.$key.'.malquestion') is-invalid @enderror" name="faqcheck[{{$key}}][malquestion]" aria-describedby="HELPNAME" placeholder="Malayalam Question" maxlength="500" minlength="3"></textarea>
                                           
                                            @error('faqcheck.'.$key.'.malquestion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>

                                           <textarea class="form-control customform eng_xxxs fg-darkCrimson @error('faqcheck.'.$key.'.enanswer') is-invalid @enderror" name="faqcheck[{{$key}}][enanswer]" aria-describedby="HELPNAME" placeholder="English Answer" maxlength="250" minlength="3"></textarea>&nbsp;

                                           
                                            @error('faqcheck.'.$key.'.enanswer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                             <!-- Malayalam Answer-->
                                            <textarea class="form-control customform eng_xxxs fg-darkCrimson @error('faqcheck.'.$key.'.malanswer') is-invalid @enderror" name="faqcheck[{{$key}}][malanswer]" aria-describedby="HELPNAME" placeholder="Malayalam Answer" maxlength="250" minlength="3"></textarea>

                                           
                                            @error('faqcheck.'.$key.'.malanswer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>


                                        <td class="text-center">
                                            @if($key == 0)
                                                <button type="button" class="btn btn-success plus"> <i class="fa fa-plus"></i> </button>
                                            @else
                                                <button type="button" class="btn btn-success plus"> <i class="fa fa-plus"></i> </button>
                                                <button type="button" class="btn btn-danger minus"> <i class="fa fa-minus"></i> </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <div id="countVar" data-count = "0"></div>
                            <tr data-id="1">
                                <th scope="row">1</th>
                                <td>
                                  <textarea class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck[1][enquestion]" aria-describedby="HELPNAME" placeholder="English Question" maxlength="250" minlength="3"></textarea>&nbsp;

                                    @error('faqcheck.1.enquestion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <!-- Malayalam question-->

                                    <textarea class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck[1][malquestion]" aria-describedby="HELPNAME" placeholder="Malayalam Question" maxlength="500" minlength="3"></textarea>

                                    @error('faqcheck.1.malquestion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>


                                   <textarea class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck[1][enanswer]" aria-describedby="HELPNAME" placeholder="English Answer" maxlength="250" minlength="3"></textarea>&nbsp;

                                   
                                    @error('faqcheck.1.enanswer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                    <!-- Malayalam Answer-->


                                   <textarea class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck[1][malanswer]" aria-describedby="HELPNAME" placeholder="Malayalam Answer" maxlength="500" minlength="3"></textarea>&nbsp;

                                   
                                    @error('faqcheck.1.malanswer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>                                 
                                <td class="text-center">
                                    <button type="button" class="btn btn-success plus"> <i class="fa fa-plus"></i> </button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                      </table>   
    
    

    </div> <!-- ./form_section -->

      </div> <!-- ./modal-body -->
      <div class="modal-footer modalover">
        <input type="hidden" name="action1" id="action1" value="Add" />
        <input type="hidden" name="hidden_id1" id="hidden_id1" />
        <button type="submit" class="btn btn-sm btn-flat eng_xxxs fg-grayWhite bg-darkMagenta"> <i class="fas fa-save"></i> &nbsp;Save changes</button>

      </div> <!-- ./modal-footer  -->
    </form>
    </div> <!-- ./modal-content -->
  </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->

<!-- Edit Modal -->


<div class="modal fade"  id="transactionmodal1" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header modalover">
        <p class="modal-title eng_xxs fg-darkEmerald" id="addmodalLabel"><i class="fab fa-wpforms"></i>&nbsp;Modal title</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- ./modal-header -->

      @if(Auth::user()->usertypes_id==3)
      <form id="ajaxmodalform" method="post" class="form-horizontal"  action="{{ route('siteadmin.faqupdate') }}">
         @elseif(Auth::user()->usertypes_id==4)
        <form id="ajaxmodalform" method="post" class="form-horizontal"  action="{{ route('webadmin.faqupdate') }}">
          @endif
     
        @csrf
      <div class="modal-body adminpage">
        
        <div id="form_section">
    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Question</th>
                                <th>Answer</th>
                                 </tr>
                        </thead>
                        <tbody>
                           
                            <tr >
                                <th scope="row">1</th>
                                <td>
                                  <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enquestion" name="enquestion" aria-describedby="HELPNAME" placeholder="English Question" maxlength="250" minlength="3"></textarea>&nbsp;

                                    @error('enquestion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <!-- Malayalam question-->

                                    <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malquestion" name="malquestion" aria-describedby="HELPNAME" placeholder="Malayalam Question" maxlength="500" minlength="3"></textarea>

                                    @error('malquestion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>


                                   <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="enanswer" name="enanswer" aria-describedby="HELPNAME" placeholder="English Answer" maxlength="250" minlength="3"></textarea>&nbsp;

                                   
                                    @error('enanswer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                    <!-- Malayalam Answer-->


                                   <textarea class="form-control customform eng_xxxs fg-darkCrimson" id="malanswer" name="malanswer" aria-describedby="HELPNAME" placeholder="Malayalam Answer" maxlength="500" minlength="3"></textarea>&nbsp;

                                   
                                    @error('malanswer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>                                 
                               
                            </tr>
                          
                        </tbody>
                      </table>   
    
    

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


$("#transactionbutton").click(function(event){
    event.preventDefault();
    $('.modal-title').text('Add New FAQ Question/Answer');
    $('#actionbutton').val('Save Details');
    $('#action').val('Add');
    $('#ajaxformresults').html('');
    $("#transactionmodal").modal('show');

    $('#name').val('');
    
});



/*$('#ajaxmodalform').on('submit', function(event){ 
    event.preventDefault();
    var action_url = '';
    if($('#action').val() == 'Add')
        action_url = "{{ route('siteadmin.faqstore') }}";

    if($('#action').val() == 'Edit')
        action_url = "{{ route('siteadmin.faqupdate') }}";

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
               alert("Already an article category with same name exists");
               
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
*/

  $(document).on('click', '.edit', function(){
      var id = $(this).attr('id'); 
      $('#ajaxformresults').html('');
      var action_url2 = '';
      var usertype=$("#usertypeid").val(); 
      if(usertype==3){
         action_url2 = "/siteadmin/faqedit/"+id;
      } else if(usertype==4){
         action_url2 = "/webadmin/faqedit/"+id;
      }
      $.ajax({
       url :action_url2,
       dataType:"json",
       success:function(data)
        { 
                      
          $('#enquestion').val(data.resultdata.enquestion);
          $('#malquestion').val(data.resultdata.malquestion);
          $('#enanswer').val(data.resultdata.enanswer);
          $('#malanswer').val(data.resultdata.malanswer);
          
          
         
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Details');
          $('#actionbutton').val('Update Details');
          $('#action').val('Edit');
          $('#transactionmodal1').modal('show');
        }
      })
  });

   $(document).on('click', '.active', function(){

    var id = $(this).attr('id'); 
    var usertype=$("#usertypeid").val();
     var action_url3 = ''; 
      if(usertype==3){
         action_url3 = "/siteadmin/faqstatus/"+id;
      } else if(usertype==4){
         action_url3 = "/webadmin/faqstatus/"+id;
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
    var action_url2 = '';
  var usertype=$("#usertypeid").val(); 
      if(usertype==3){
         action_url2 = "/siteadmin/faqdestroy/"+element_id;
      } else if(usertype==4){
         action_url2 = "/webadmin/faqdestroy/"+element_id;
      }
    $.ajax({
            url:action_url2,
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


/**/

 $('body').on('click', '.plus', function() { 
        // i = $('#tab_logic tr').length; 
        var i =  $('#faqcheck tr:last').data('id');
        i = i+1;
        $('#faqcheck').append('<tr data-id="'+ i +'">\
            <th scope="row">'+ i +'</th>\
            <td>\
                <textarea placeholder="English Question" class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck['+ i +'][enquestion]"></textarea>&nbsp;<textarea placeholder="Malayalam Question" class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck['+ i +'][malquestion]"></textarea>\
            </td>\
            <td>\
                <textarea placeholder="English Answer" class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck['+ i +'][enanswer]" ></textarea>&nbsp;<textarea placeholder="Malayalam Answer" class="form-control customform eng_xxxs fg-darkCrimson" name="faqcheck['+ i +'][malanswer]" ></textarea>\
            </td>\
            <td class="text-center">\
                <button type="button" class="btn btn-success plus"> <i class="fa fa-plus"></i> </button>\
                <button type="button" class="btn btn-danger minus"> <i class="fa fa-minus"></i> </button>\
            </td>\
        </tr>');
        // i++;
    });
    $('body').on('click', '.minus', function() {
        $(this).closest('tr').remove();
        // i--;
    });
</script>
@endsection