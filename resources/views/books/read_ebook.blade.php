@extends('layouts.app')

<link rel="stylesheet" href="/css/reader.css"> 
@section('content')
<div class="readre-table-container">
    <div class="reader-left">
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
        <div class="row-two">
            <div class="unit">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>
            <div class="unit">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>
            <div class="unit active">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>
            <div class="unit">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>
            <div class="unit">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>
            <div class="unit">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>
            <div class="unit">
                <div class="title">Title page</div>
                <div class="index">2</div>
            </div>

        </div>
    </div>
    <div class="reader-right">
        <div class="reader-header">
            <div class="icons">
                <img src="/images/reader/table.png" alt="dashboard"/>
                <img src="/images/reader/search.png" alt="search"/>
                <img src="/images/reader/shape.png" alt="shape"/>
                <img src="/images/reader/text.png" alt="text"/>
            </div>
            <div class="content">
                The Girl on the Train
            </div>
            <div class="closes">
                <img src="/images/reader/back.png"/>
            </div>
        </div>
        <div class="reader-content">
            <div class="left-slide">

            </div>
            <div class="right-section">
                It’s a relief to be back on the 8:04. It’s not that I can’t wait to get into London to start my week—I don’t particularly want to be in London at all. I just want to lean back in the soft, sagging velour seat, feel the warmth of the sunshine streaming through the window, feel the carriage rock back and forth and back and forth, the comforting rhythm of wheels on tracks. I’d rather be here, looking out at the houses beside the track, than almost anywhere else.
                There’s a faulty signal on this line, about halfway through my journey. I assume it must be faulty, in any case, because it’s almost always red; we stop there most days, sometimes just for a few seconds, sometimes for minutes on end. If I sit in carriage D, which I usually do, and the train stops at this signal, which it almost always does, I have a perfect view into my favourite trackside house: number fifteen.
                Number fifteen is much like the other houses along this stretch of track: a Victorian semi, two storeys high, overlooking a narrow, well-tended garden that runs around twenty feet down towards some[…]»

                Отрывок из книги: Paula Hawkins. «The Girl on the Train». iBooks.
            </div>
            <div class="right-section">
                Number fifteen is much like the other houses along this stretch of track: a Victorian semi, two storeys high, overlooking a narrow, well-tended garden that runs around twenty feet down towards some fencing, beyond which lie a few metres of no-man’s-land before you get to the railway track. I know this house by heart. I know every brick, I know the colour of the curtains in the upstairs bedroom (beige, with a dark-blue print), I know that the paint is peeling off the bathroom window frame and that there are four tiles missing from a section of the roof over on the right-hand side.
                I know that on warm summer evenings, the occupants of this house, Jason and Jess, sometimes climb out of the large sash window to sit on the makeshift terrace on top of the kitchen-extension roof. They are a perfect, golden couple. He is dark-haired and well built, strong, protective, kind. He has a great laugh. She is one of those tiny bird-women, a beauty, pale-skinned with blond hair cropped short. She has the bone structure to carry that kind of thing off, sharp cheekbones dappled with a sprinkling of freckles, a fine jaw.
                While we’re stuck at the red signal, I look for them. Jess is often out there in the mornings, especially in the summer, drinking her coffee. Sometimes, when I see her there, I feel as though she[…]»

                Отрывок из книги: Paula Hawkins. «The Girl on the Train». iBooks.
            </div>
            <div class="right-slide">

            </div>
        </div>
        <div class="reader-page">Page 15 of 280 ( 22%)</div>
        <div class="reader-footer">
            <div class="bar"></div>
        </div>

    </div>
</div>
@endsection 
@section('footer_scripts') 
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