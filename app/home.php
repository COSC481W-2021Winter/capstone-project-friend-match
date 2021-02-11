<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css"/>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
  </head>

  <body>
      <div id="deck">
        <div class="buddy"><p style="color: #000;">Text test</p></div>
        <div class="buddy"><h3 style="color: #000;">Name</h3><p>Biography</p></div>
      </div>
  </body>

  <script>
  $(document).ready(function(){

  $(".buddy").on("swiperight",function(){
    $(this).addClass('rotate-left').delay(700).fadeOut(1);
    $('.buddy').find('.status').remove();

    if ( $(this).is(':last-child') ) {
      $('.buddy:nth-child(1)').removeClass ('rotate-left rotate-right').fadeIn(300);
     } else {
        $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
     }
  });

 $(".buddy").on("swipeleft",function(){
  $(this).addClass('rotate-right').delay(700).fadeOut(1);
  $('.buddy').find('.status').remove();

  if ( $(this).is(':last-child') ) {
   $('.buddy:nth-child(1)').removeClass ('rotate-left rotate-right').fadeIn(300);
    alert('OUPS');
   } else {
      $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
  }
});

});
  </script>

</html>
