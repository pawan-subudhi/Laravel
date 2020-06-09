// for like, bookmark button and apply button
$(document).ready(function(){
  // for like button
  $(".btn-submit-like").click(function(e){
    e.preventDefault();
    if(document.getElementById("like-button").style.color == 'black'){
      var toggleColor = 'red';
      var toggleUrl = "/dislike/";
    } else {
      var toggleColor = 'black';
      var toggleUrl = "/like/";
    }
    url = $(this).attr("data-url")+$(this).attr("data-id");
    $.ajax({
       type:'POST',
       url: url,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       success:function(data){
         var buttonDataUrl = document.getElementsByClassName("btn-submit-like");
         buttonDataUrl[0].setAttribute("data-url",toggleUrl);
         document.getElementById("like-button").style.color = toggleColor;
       }
    });
  });

  // for favourite button
  $(".btn-submit-favourite").click(function(e){
    e.preventDefault();
    if(document.getElementById("favourite-button").style.color == 'black'){
      var toggleColor = 'red';
      var toggleUrl = "/unsave/";
    } else {
      var toggleColor = 'black';
      var toggleUrl = "/save/";
    }
    url = $(this).attr("data-url")+$(this).attr("data-id");
    $.ajax({
       type:'POST',
       url: url,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       success:function(data){
         var buttonDataUrl = document.getElementsByClassName("btn-submit-favourite");
         buttonDataUrl[0].setAttribute("data-url",toggleUrl);
         document.getElementById("favourite-button").style.color = toggleColor;
       }
    });
  });

   // for apply button
  $(".btn-submit-apply").click(function(e){
    e.preventDefault();
    url = $(this).attr("data-url")+$(this).attr("data-id");
    $.ajax({
       type:'POST',
       url: url,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       success:function(data){
         var buttonDataUrl = document.getElementsByClassName("btn-submit-apply");
         buttonDataUrl[0].disabled = 'true';
         document.getElementById("application-status").style.display = "block";
       }
    });
  });

});
