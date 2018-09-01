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
    <div class="content">
                {{$book->ebooktitle}}
            </div>
    <iframe src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/pdfviewer/web/viewer.html?file=../../uploads/ebook_logo/{{$book->buyLink}}" style="width: 100%" height="700"></iframe>
    @else
    <div class="reader-left menu-panel">
        <div class="row-one">
            <div class="unit-one active">
                <div class="content">Table of
                    contents</div>
            </div>
            <div class="unit-one ">
                <div class="content">
                    Book info
                </div>
            </div>
            <div class="unit-one">
                <div class="content">
                    Notes
                </div>
            </div>

        </div>
        <div id="menu-toc" class="row-two menu-toc">
            @if($chapters) 
            @foreach($chapters as $key=>$chapter)
            <div class="unit {{($key==0) ? 'menu-toc-current' : '' }}">
                <div class="title"><a href="#item{{$key+1}}">{{$chapter['name']}}</a></div>
                <div class="index"></div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="reader-right">
        <div class="reader-header">
            <div class="icons">
                <span id="tblcontents" ><img src="/images/reader/table.png" alt="dashboard"/></span>
                <img src="/images/reader/search.png" alt="search"/>
                <img src="/images/reader/shape.png" alt="shape"/>
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
        <div class="reader-page">Page 15 of 280 ( 22%)</div>
        <div class="reader-footer">
            <div class="bar"></div>
        </div>
        @endif
    </div>
    @endif
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

    $(this).parent().siblings("div").hide();
    $("#"+currenttab).show();

});

$(".row-two .unit").click(function(){
    $(this).parent().children().removeClass("active");
    $(this).addClass("active");
});

</script>
@endsection