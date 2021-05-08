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
     <p class="py-2"> <strong > <i class="fas fa-hand-point-right"></i> &nbsp; Reset Password </strong></p>
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
    <div class="col-12">
      @if(Auth::user()->usertypes_id == 1)
      <form action="{{ route('admin.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 2)
      <form action="{{ route('appadmin.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 3)
      <form action="{{ route('siteadmin.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 4)
      <form action="{{ route('webadmin.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 5)
      <form action="{{ route('editor.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 6)
      <form action="{{ route('photoeditor.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 7)
      <form action="{{ route('moderator.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @elseif(Auth::user()->usertypes_id == 8)
      <form action="{{ route('publisher.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 9)
      <form action="{{ route('appmanager.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 10)
      <form action="{{ route('appclient.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 11)
      <form action="#" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 12)
      <form action="{{ route('livestreaming.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 13)
      <form action="#" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 14)
      <form action="{{ route('depthead.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 15)
      <form action="{{ route('deptasst.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
        @elseif(Auth::user()->usertypes_id == 16)
      <form action="{{ route('deptso.resetpasswordaction') }}" name="resetpasswordfrm" id="resetpasswordfrm" method="post" >
      @endif  
      @csrf
          <div id="form_section">
    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME" class="eng_xxxs fg-darkBrown">Username</label>
        <small id="HELPNAME" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
          <input type="text" id="username" name="username" maxlength="40" minlength="8" class="form-control customform eng_xxxs fg-darkCrimson" aria-describedby="HELPNAME" placeholder="Enter the User name" required>
        <p id="usernameerror" style="display:none; color:#FF0000;" >Invalid Username.</p>
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2">
        <label for="IDNAME1" class="eng_xxxs fg-darkBrown">Choose type</label>
        <small id="HELPNAME1" class="form-text eng_xxxxs text-muted"> additional information.</small>
      </div> <!-- ./col-md-6 -->
      <div class="col-md-6 py-2">
        
      <input type="checkbox" id="resettype" name="resettype" value="1">&nbsp;SMS&nbsp;&nbsp;
       <input type="checkbox" id="resettype" name="resettype" value="2">&nbsp;Email&nbsp;&nbsp; 
       <input type="checkbox" id="resettype" name="resettype" value="3">&nbsp;Both&nbsp;&nbsp;
      </div> <!-- ./col-md-6 -->
    </div> <!-- ./row -->

    <div class="row customformrow">
      <div class="col-md-6 py-2 justify-content-center d-flex">
        
        <button class="btn btn-sm btn-flat eng_xxxs bg-lightOrange fg-darkCrimson"> <i class="fas fa-broom"></i>&nbsp;Reset </button> &nbsp;&nbsp;
        </div>
        <div class="col-md-6 py-2 justify-content-center d-flex">
        
           <button class="btn btn-sm btn-flat eng_xxxs bg-darkAmber fg-lightGray px-3"> <i class="fas fa-save"></i>&nbsp;Submit </button>
       
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

$('#username').on('change ', function(e) {
  var testval = this.value;
  if(testval != '')
  {
    var tested = new RegExp('^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$');
    if (!tested.test(testval))
    {
      $('#username').val('');
      $('#usernameerror').slideDown("slow");
     
    }
    else
    {
       $('#emailerror').hide();
       
      
    }
 }
});
/*---------------------------------- End of Document Ready ---------------------------*/

(function() {
    const form = document.querySelector('#resetpasswordfrm');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one checkbox must be selected.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();

});
</script>
@endsection
