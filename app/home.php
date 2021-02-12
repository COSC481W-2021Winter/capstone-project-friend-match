<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>

    <script>
      $(function() {
        $(".inner-card").draggable(
          {
            axis: 'x',
            containment: ".outer-deck",
            stop: function(event_type, ui){
              $(this).hide();
              console.log("stopped dragging");
            }
          });
      });

      // var swipe_left = 0;
      // var swipe_right = 0;
      //
      // $(".inner-card").on("swipeleft", function(){
      //   swipe_left = swipe_left + 1;
      //   console.log(swipe_left);
      //   $(this).hide();
      // });
      //
      // $(".inner-card").on("swiperight", function(){
      //   swipe_right = swipe_right + 1;
      //   console.log(swipe_right);
      //   $(this).hide();
      // });
    </script>
  </head>

  <body>
    <!-- Cards -->
      <div class="outer-deck" id="deck">
        <!-- deck plays by "sandwich rules" (first div is bottom, like the bread) -->
        <div class="inner-card"><p style="color: #000;">Swipe test</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
        <div class="inner-card"><p style="color: #000;"><b>Name</b><br>Biography</p></div>
      </div>
  </body>

</html>
