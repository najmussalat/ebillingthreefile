<div class="navbar @if(($configData['isNavbarFixed'])=== true){{'navbar-fixed'}} @endif">
  <nav
    class="{{$configData['navbarMainClass']}} @if($configData['isNavbarDark']=== true) {{'navbar-dark'}} @elseif($configData['isNavbarDark']=== false) {{'navbar-light'}} @elseif(!empty($configData['navbarBgColor'])) {{$configData['navbarBgColor']}} @else {{$configData['navbarMainColor']}} @endif">
    <div class="nav-wrapper">
      <div class="header-search-wrapper hide-on-med-and-down" id="MyClockDisplay" onload="showTime()">
       
       {{--<input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize 1"
          data-search="starter-kit-list">
        <ul class="search-list collection display-none"></ul> --}}
      </div>
      <ul class="navbar-list right">
        
       
        <li class="hide-on-large-only search-input-wrapper">
          <a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);">
            <i class="material-icons">search</i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);"
            data-target="notifications-dropdown" id="seennotify">
            <i class="material-icons">notifications_none<small class="notification-badge">{{ auth()->user()->unreadNotifications->count() }}</small></i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
            data-target="profile-dropdown">
            <span class="avatar-status avatar-online">
              <img src="{{@asset('storage/app/files/shares/profileimage/'.Auth::user()->image)}}" alt="avatar"><i></i>
            </span>
          </a>
        </li>
      
      </ul>
      <!-- translation-button-->
      <ul class="dropdown-content" id="translation-dropdown">
        <li class="dropdown-item">
          <a class="grey-text text-darken-1" href="{{url('lang/en')}}" data-language="en">
            <i class="flag-icon flag-icon-gb"></i>
            English
          </a>
        </li>
      
       
      </ul>
      <!-- notifications-dropdown-->
      <ul class="dropdown-content" id="notifications-dropdown">
        <li>
          <h6 id="notificationsdropdown">Clear<span class="new badge" >{{ auth()->user()->unreadNotifications->count() }}</span></h6>
        </li>
        <li class="divider"></li>
        @foreach(auth()->user()->unreadNotifications as $notification)
               <li>
                 {!! ($notification->data['data']) !!}
          <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">{{($notification->created_at)->diffForHumans() }}</time>
        </li>
        @endforeach
        @foreach(auth()->user()->readNotifications as $notification)
        <li class="#e8f5e9 green lighten-5">
          {!! ($notification->data['data']) !!}
   <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">{{($notification->created_at)->diffForHumans() }}</time>
 </li>
 @endforeach
      </ul>
      <!-- profile-dropdown-->
      <ul class="dropdown-content" id="profile-dropdown">
        <li>
          <a class="grey-text text-darken-1" href="{{url('admin/profile')}}">
            <i class="material-icons">person_outline</i>
            Profile
          </a>
        </li>
        
        <li class="divider"></li>
         <li><a class="grey-text text-darken-1" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="material-icons">keyboard_tab</i> Sign out   </a>
       <form id="logout-form"  action="{{ route('logout') }}" method="POST" style="display: none;">
        <input  type="hidden" name="user" value="customer">
           @csrf
       </form>
      </li>
       
      </ul>
    </div>
   
  </nav>
</div>
<script>
  function showTime(){
   var date = new Date();
   var h = date.getHours(); // 0 - 23
   var m = date.getMinutes(); // 0 - 59
   var s = date.getSeconds(); // 0 - 59
   var session = "AM";
   
   if(h == 0){
       h = 12;
   }
   
   if(h > 12){
       h = h - 12;
       session = "PM";
   }
   
   h = (h < 10) ? "0" + h : h;
   m = (m < 10) ? "0" + m : m;
   s = (s < 10) ? "0" + s : s;
   
   var time = h + ":" + m + ":" + s + " " + session;
   document.getElementById("MyClockDisplay").innerText = time;
   document.getElementById("MyClockDisplay").textContent = time;
   
   setTimeout(showTime, 1000);
   
}

showTime();

  </script>
