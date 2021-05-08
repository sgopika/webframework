@extends('layouts.basemain')
@section('content')
<div class="container-fluid homepage adminpage">
  <div class="row pt-3">
    <div class="col-12 py-2  ">
<!-- Start of breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumbinner py-1 eng_xxxs">
  <ol class="breadcrumb justify-content-end px-3 pt-2">
     @if(Auth::user()->usertypes_id == 1)
        <li class="breadcrumb-item"><a class="no_link" href="{{ route('adminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @elseif(Auth::user()->usertypes_id == 2)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('appadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @elseif(Auth::user()->usertypes_id == 3)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('siteadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @elseif(Auth::user()->usertypes_id == 4)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('webadminhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @elseif(Auth::user()->usertypes_id == 5)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('editorhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @elseif(Auth::user()->usertypes_id == 6)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('photoeditorhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @elseif(Auth::user()->usertypes_id == 7)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('moderatorhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 8)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('publisherhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 9)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('appmanagerhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 10)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('appclienthome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 11)
      <li class="breadcrumb-item"><a class="no_link" href="#"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 12)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('livestreaminghome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 13)
      <li class="breadcrumb-item"><a class="no_link" href="#"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 14)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptheadhome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 15)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptassthome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
      @elseif(Auth::user()->usertypes_id == 16)
      <li class="breadcrumb-item"><a class="no_link" href="{{ route('deptsohome') }}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    @endif
  </ol>
  
</nav>
<!-- End of breadcrumb -->
</div>
<div class="col-12 py-1">
     <p class="py-2"> <strong > <i class="fas fa-hand-point-right"></i> &nbsp; Change Password </strong></p>
   </div>
   
    <div class="col-12">
      @if(Auth::user()->usertypes_id == 1)
      <form action="{{ route('admin.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 2)
      <form action="{{ route('appadmin.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 3)
      <form action="{{ route('siteadmin.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 4)
      <form action="{{ route('webadmin.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 5)
      <form action="{{ route('editor.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 6)
      <form action="{{ route('photoeditor.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 7)
      <form action="{{ route('moderator.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 8)
      <form action="{{ route('publisher.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 9)
      <form action="{{ route('appmanager.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 10)
      <form action="{{ route('appclient.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 11)
      <form action="#" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 12)
      <form action="{{ route('livestreaming.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 13)
      <form action="#" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 14)
      <form action="{{ route('depthead.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 15)
      <form action="{{ route('deptasst.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 16)
      <form action="{{ route('deptso.changepasswordaction') }}" name="changepasswordfrm" id="changepasswordfrm" method="post" >
      @endif  
      @csrf
          <div id="form_section">
    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">New Password</label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <input type="password" id="newpassword" name="newpassword" maxlength="40" minlength="8" class="form-control" required>
          <span class="eng_xxxs text-danger" id="newpwddiv"></span>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME1" class="eng_xxxs fg-darkBrown">Confirm Password</label>
        <small id="HELPNAME1" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
      <input type="password" id="confirmpassword" name="confirmpassword" maxlength="40" minlength="8" class="form-control" required>
       <span class="eng_xxxs text-danger" id="confirmpwddiv"><i class="fas fa-exclamation"></i>&nbsp;Passwords doesnot match. </span>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    

    <div class="row customformrow">
      <div class="col-md-6 py-2 justify-content-center d-flex">
        
        <button class="btn btn-sm btn-flat eng_xxxs bg-lightOrange fg-darkCrimson"> <i class="fas fa-broom"></i>&nbsp;Reset </button> &nbsp;&nbsp;
        </div>
        <div class="col-md-6 py-2 justify-content-center d-flex">
        
           <button class="btn btn-sm btn-flat eng_xxxs bg-darkAmber fg-lightGray px-3"> <i class="fas fa-save"></i>&nbsp;Change password </button>
       
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->
    
    <div class="row customformrow">
     <div class="col-md-12 py-2">
      <span class="eng_xxxs text-blue"> <i class="fas fa-exclamation-circle"></i>&nbsp;New Password shall contain atleast one uppercase, one lower case character, one number and a special character. Minimum length of password: 8. Example: kerAla851@13<br> Please remember this password for future login. </span>
    </div>
    </div>

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

$('#oldpwddiv').hide();
$('#newpwddiv').hide();
$('#confirmpwddiv').hide();
$('#changepassword').show();


$('#oldpassword2').on('change ', function() {
  var oldpassword = $('#oldpassword').val();
     $('#ajaxformresults').html('');
    $.ajax({
        url : '/admin/checkoldpassword/'+oldpassword,
        type: "GET",
        dataType:"json",
        success:function(data)
        {
          if(data.flagvalue == 0)
          {
            $("#oldpassword").val('');
            $("#oldpwddiv").show();                
          }
          else
          {
             $("#oldpwddiv").hide();
          }
        }
     })
}); 

$('#newpassword').on('change ', function() {
  var check = 0;
  $("#newpwddiv").html('');
  var newpwsmsg = '';
  var pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
  var newpassword = $('#newpassword').val();
   if(!pattern.test(newpassword)) {
    $('#newpassword').val('');
    newpwsmsg+="Password should contain atleast one number, one upper case letter, one lower case letter and special character. ";
    check++;
  }

  if(newpassword.length < 8)
  {
    newpwsmsg+="Password shall be minimum 8 characters in length.";
    check++;
  }

  var confirmpassword = $('#confirmpassword').val('');
  if(check !=0 )
  {
    $("#newpwddiv").html(newpwsmsg);
    $("#newpwddiv").show();  
  }

}); 

$('#confirmpassword').on('change ', function() {
  var newpassword = $('#newpassword').val();
  var confirmpassword = $('#confirmpassword').val();
  if(confirmpassword != newpassword)
  {
     $("#newpassword").val('');
     $("#confirmpassword").val('');
     $("#confirmpwddiv").show();
  }
  else
  {
     $("#confirmpwddiv").hide();
  }
});

$( ".closelogin" ).click(function() {
     
      window.location.reload();
        
  });

/*---------------------------------- End of Document Ready ---------------------------*/
});
</script>
@endsection
