var addFunctionOnWindowLoad = function(callback){
      if(window.addEventListener){
          window.addEventListener('load',callback,false);
      }else{
          window.attachEvent('onload',callback);
      }
};


// $(document).scroll(function() {
//     $("div:not(.highlight)").each(function() {
//         if (isScrolledIntoView(this)) {
//            $("div").removeClass("highlight");
//            $(this).addClass("highlight");
//            $("body").animate({ scrollTop: $(this).offset().top }, 1000)
//         }
//     });
// });

// function isScrolledIntoView(elem)
// {
//     var docViewTop = $(window).scrollTop();
//     var docViewBottom = docViewTop + $(window).height();

//     var elemTop = $(elem).offset().top;
//     var elemBottom = elemTop + $(elem).height();

//     return (elemTop <= docViewBottom) && (elemTop > docViewTop);
// }​;

/* $('.collapsible').collapsible({
      accordion: false, // A setting that changes the collapsible behavior to expandable instead of the default accordion style
      onOpen: function(el) { alert('Open'); }, // Callback for Collapsible open
      onClose: function(el) { alert('Closed'); } // Callback for Collapsible close
    }
  );*/