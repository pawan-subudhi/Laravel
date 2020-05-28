<footer class="site-footer">
    <div class="container">
      

      <div class="row">
        <div class="col-md-4">
          <h3 class="footer-heading mb-4 text-white">About</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet.</p>
          <p><a href="#" class="btn btn-primary pill text-white px-4">Read More</a></p>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3 class="footer-heading mb-4 text-white">Quick Menu</h3>
                <ul class="list-unstyled">
                  <li><a href="#">About</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Approach</a></li>
                  <li><a href="#">Sustainability</a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-6">
              <h3 class="footer-heading mb-4 text-white">Categories</h3>
                <ul class="list-unstyled">
                  <li><a href="#">Full Time</a></li>
                  <li><a href="#">Freelance</a></li>
                  <li><a href="#">Temporary</a></li>
                  <li><a href="#">Internship</a></li>
                </ul>
            </div>
          </div>
        </div>

        
        <div class="col-md-2">
          <div class="col-md-12"><h3 class="footer-heading mb-4 text-white">Social Icons</h3></div>
            <div class="col-md-12">
              <p>
                <a href="#" class="pb-2 pr-2 pl-0">
                  <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>
                <a href="#" class="p-2">
                  <i class="fa fa-twitter-square" aria-hidden="true"></i>
                </a>
                <a href="#" class="p-2">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </p>
            </div>
        </div>
      </div>
      <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
          <p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="icon-heart text-warning" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
        
      </div>
    </div>
  </footer>
</div>

<script src="{{asset('external/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('external/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('external/js/jquery-ui.js')}}"></script>
<script src="{{asset('external/js/popper.min.js')}}"></script>
<script src="{{asset('external/js/bootstrap.min.js')}}"></script>
<script src="{{asset('external/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('external/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('external/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('external/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('external/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('external/js/aos.js')}}"></script>


<script src="{{asset('external/js/mediaelement-and-player.min.js')}}"></script>

<script src="{{asset('external/js/main.js')}}"></script>
  
<script>
    document.addEventListener('DOMContentLoaded', function() {
              var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;

              for (var i = 0; i < total; i++) {
                  new MediaElementPlayer(mediaElements[i], {
                      pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
                      shimScriptAccess: 'always',
                      success: function () {
                          var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
                          for (var j = 0; j < targetTotal; j++) {
                              target[j].style.visibility = 'visible';
                          }
                }
              });
              }
          });
  </script>

<!-- for like, bookmark button and apply button  -->
{{-- <script type="text/javascript">
  $.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

// for like button
$(".btn-submit-like").click(function(e){
 e.preventDefault();
 if(document.getElementById("like-button").style.color == 'black'){
   var url = "{{route('like',[$job->id])}}";
   var toggleColor = 'red';
 } else {
   var url = "{{route('dislike',[$job->id])}}";
   var toggleColor = 'black';
 }
 
 $.ajax({
       type:'POST',
       url: url,
       success:function(data){
         document.getElementById("like-button").style.color = toggleColor;
       }
 });
 });  

// for favourite button
$(".btn-submit-favourite").click(function(e){
 e.preventDefault();
 if(document.getElementById("favourite-button").style.color == 'black'){
   var url = "{{route('save',[$job->id])}}";
   var toggleColor = 'red';
 } else {
   var url = "{{route('unsave',[$job->id])}}";
   var toggleColor = 'black';
 }
 
 $.ajax({
       type:'POST',
       url: url,
       success:function(data){
         document.getElementById("favourite-button").style.color = toggleColor;
       }
 });
 });

//for apply button
$(".btn-submit-apply").click(function(e){
 e.preventDefault();
 var button = document.getElementsByClassName("btn-submit-apply");
 var url = "{{route('apply',[$job->id])}}";
 $.ajax({
       type:'POST',
       url: url,
       success:function(data){
           button[0].disabled = 'true';
           document.getElementById('application-status').style.display = 'block';
       }
 });
 });

</script> --}}
