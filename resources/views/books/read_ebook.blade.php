@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="/css/reader/jquery.jscrollpane.custom.css" />
<link rel="stylesheet" type="text/css" href="/css/reader/bookblock.css" />
<link rel="stylesheet" type="text/css" href="/css/reader/custom.css" /> 
@section('free-book-css')

<link rel="stylesheet" href="/css/reader.css">
<script src="/js/reader/modernizr.custom.79639.js"></script>
@endsection
@section('content')
<div id="container" class="readre-table-container">
     @if(!empty($book->book_ext) && $book->book_ext == 'pdf')

     @endif

    <div class="reader-right" style="width: 100%; margin-bottom: 20px;">
        @if(!empty($book->book_ext) && $book->book_ext == 'pdf')
        <div class="reader-content" style="margin-left: 0px">
        <iframe src="https://<?php echo $_SERVER['HTTP_HOST']; ?>/pdfviewer/web/viewer.html?file=/uploads/ebook_logo/{{$book->buyLink}}" style="width: 100%;border-width:0px;" height="700" ></iframe>
        </div>
        @else
        <div class="reader-header">
            <div class="icons">
                <span id="tblcontents" ><img src="/images/reader/table.png" alt="dashboard"/></span>
                <img src="/images/reader/search.png" alt="search"/>
                @if($currentUser)
                <img src="/images/reader/shape.png" alt="shape" onclick="manageBookmark({{$book->id}}, {{$currentUser->id}})" />
                @endif
                <img src="/images/reader/text.png" alt="text"/>
            </div>
            <div class="content">
                {{$book->ebooktitle}}
            </div>
            <nav>
                    <span id="bb-nav-prev">&larr;</span>
                    <span id="bb-nav-next">&rarr;</span>
                </nav>
            <div class="closes">

                <img src="/images/reader/back.png"/>
            </div>
        </div>
        @if($chapters && !empty($chapters))
        <div class="reader-content">
            <div class="bb-custom-wrapper">
                <div id="bb-bookblock" class="bb-bookblock">
                     
                    @foreach($chapters as $key=>$chapter)
                    <div class="bb-item" id="item{{$key+1}}">
                        <div class="pagecontent">
                            <div class="scroller">{!! $chapter['content'] !!}</div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="reader-page">Page <span>1</span> of {{count($chapters)}} </div>
        <div class="reader-footer">
            <div class="bar" style="width: <?php echo (1/count($chapters))*100; ?>%"></div>
        </div>
        @endif
        @endif
    </div>
    
</div>
@endsection 
@section('footer_scripts') 

<script src="/js/reader/jquery.mousewheel.js"></script>
<script src="/js/reader/jquery.jscrollpane.min.js"></script>
<script src="/js/reader/jquerypp.custom.js"></script>
<script src="/js/reader/jquery.bookblock.js"></script>
<script src="/js/reader/page.js"></script>
@if($chapters && !empty($chapters)) 
<script>
    $(function() {

        Page.init();

    });
</script>
@endif
<script type="text/javascript">
$(".row-one .unit-one").click(function(){
    $(this).parent().children().removeClass("active");
    $(this).addClass("active");

    var currenttab=$(this).attr("data-tab");
    console.log('currenttab',currenttab);
    $(this).parent().siblings("div").hide();
    $("#"+currenttab).show();

});

$("#bookMark.row-two .unit").click(function(){
    $(this).parent().children().removeClass("active bookMarkActive");
    $(this).addClass("active bookMarkActive");
});
var bookmarkArr = <?php echo json_encode($bm_arr); ?>;
function manageBookmark(book_id, user_id) {
  console.log('bookmarkArr', bookmarkArr);

  var chapter_id = $('.menu-toc .unit.active').attr('data-chapter-id');
  var chapter_index = parseInt(chapter_id)+1;
  console.log('chapter_id', chapter_id,chapter_index, $.inArray(chapter_index, bookmarkArr));
  if($.inArray(chapter_index, bookmarkArr) < 0)
  {
    bookmarkArr.push(chapter_index);
    $('#bookMark div.cpindex'+chapter_id).show();
    // var newContent = $('#tableContent div.unit.active').html();
    // var updContent  = '<div class="unit">'+newContent+'</div>';
    // var newContent = $('#tableContent div.unit.active')[0].outerHTML;
    // $('#bookMark').append(updContent);
    // console.log('bookmarkArr', bookmarkArr, tmp);
  }
  
}
</script>
@endsection