$(document).ready(function(){
  /* This code is executed after the DOM has been completely loaded */

  // var tmp;
  
  // $('.note').each(function(){
  //   Finding the biggest z-index value of the notes 
  //  tmp = $(this).css('z-index');
  //  if(tmp>zIndex) zIndex = tmp;
  // })

  // $("a#inline").fancybox({
  //   'hideOnContentClick': true
  // });

  /* A helper function for converting a set of elements to draggables: */
  // make_draggable($('.note'));
  
  /* Configuring the fancybox plugin for the "Add a note" button: */
  // $("#addButton").fancybox({
  //  'zoomSpeedIn'   : 600,
  //  'zoomSpeedOut'    : 500,
  //  'easingIn'      : 'easeOutBack',
  //  'easingOut'     : 'easeInBack',
  //  'hideOnContentClick': false,
  //  'padding'     : 15
  // });
  
  /* Listening for keyup events on fields of the "Add a note" form: */
  // $('.pr-body,.pr-author').live('keyup',function(e){
  //  if(!this.preview)
  //    this.preview=$('#fancy_ajax .note');
    
  //  this.preview.find($(this).attr('class').replace('pr-','.')).html($(this).val().replace(/<[^>]+>/ig,''));
  // });
  
  /* Changing the color of the preview note: */
  // $('.color').live('click',function(){
  //  $('#fancy_ajax .note').removeClass('yellow green blue').addClass($(this).attr('class').replace('color',''));
  // });
  
  /* The submit button: */
  $('#note-submit').click(function(e){
   e.preventDefault();
   if($('.pr-body').val().length<4)
   {
     alert("The note text is too short!")
     return false;
   }
    
   $('.noteBtn').hide();
   $('.noteLoader').show();
   var tmpChapter = parseInt($('#tableContent div.menu-toc-current').attr('data-chapter-id'))+1;
   var noteText = $('.pr-body').val();
   var data = {
     'zindex'  : ++zIndex,
     'body'    : noteText,
     'book_id' : $('meta[name="book-id-note"]').attr('content'),
     'chapter' : tmpChapter,
     '_token' : $('meta[name="csrf-token"]').attr('content')
   };
    
    
   /* Sending an AJAX POST request: */
   $.post('/book/addnote',data,function(msg){
     if(msg)
     {
        $('.noteBtn').show();
        $('.noteLoader').hide();
        $('.userNotes ul').append('<li><a href="#item'+tmpChapter+'">'+noteText+'</a></li>');
        $('.pr-body').val('');
        $.fancybox.close();
        $('#selectionSharerPopover').hide();
     }
   });
    
   e.preventDefault();
  })
  
  // $('.note-form').live('submit',function(e){e.preventDefault();});
});

var zIndex = 0;

function make_draggable(elements)
{
  /* Elements is a jquery object: */
  
  elements.draggable({
    containment:'parent',
    start:function(e,ui){ ui.helper.css('z-index',++zIndex); },
    stop:function(e,ui){
      
      /* Sending the z-index and positon of the note to update_position.php via AJAX GET: */

      $.get('ajax/update_position.php',{
          x   : ui.position.left,
          y   : ui.position.top,
          z   : zIndex,
          id  : parseInt(ui.helper.find('span.data').html())
      });
    }
  });
}