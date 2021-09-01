<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy Powerd by <a href="https://www.facebook.com/RongdhonuIt-706680669690980">Virtuanic Ltd {{date('Y')}}</a>
      </span>
      <span class="right hide-on-small-only">
        Design and Developed by <a href="https://virtuanic.com/">Virtuanic</a>
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer-->