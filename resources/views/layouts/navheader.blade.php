<nav class="navbar navbar-dark navbarcustom">
 
  
  <div class="container-fluid">
    <a class="navbar-brand  eng_xli" href="#"> 
      <img src=""  class="logoimg">  
      <span class="userauthdiv"> Title  </span></a>
    
    <div class="pull-right userauthdiv">
    <span class="  eng_xxs"> Welcome, {{ Auth::user()->name }}  </span>
    <a class=" no_link controlbutton " href="{{ route('logout') }}" data-toggle="tooltip" data-placement="top" title="Logout">&nbsp;<i class="fas fa-power-off "></i>
    </a>
     
  </div> 
  
</div> <!-- inner-container -->
</nav>