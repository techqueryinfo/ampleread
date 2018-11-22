@extends('layouts.admin')
@section('content')
<!-- book category page-->
<div class="admin-book-category">
    <div class="first-row">
        <div class="user-sections">
            <div class="unit active" data-attr="created-book">
                <a href="#">Created books</a>
            </div>
            <div class="unit" data-attr="submitted-book">
                <a href="#">submitted books</a>
            </div>
        </div>
    </div>
    <div class="second-row">
        <div class="created-book active" style="display: block;">
        	@foreach($created_books as $val)
            <div class=" row item">
                <div class="edit-delete">
                    <div class="edit"><a href="{{ url('books/ebook/'.$val->id.'/'.$val->ebooktitle) }}" target="_blank"><i class="fas fa-eye"></i></a></div>
                </div>
                <div class="image">
                	@if(substr($val->ebook_logo, 0, 4) == "http")
                        <img src="{{ $val->ebook_logo }}" alt="img1" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $val->ebook_logo }}" alt="img1" />
                    @endif
                </div>
                <div class="title">{{ $val->ebooktitle }}: {{$val->subtitle}}</div>
                <div class="writer">@if(isset($val->publisher)){{$val->publisher}}@else Publisher @endif</div>
                <form action="{{ url('admin/books/approve/'.$val->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="book_id" value="{{$val->id}}">
                    <input type="hidden" name='status' value='2'/>
                    <input type="submit" value="APPROVE"/>
                </form>
                <form action="{{ url('admin/books/decline/'.$val->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="book_id" value="{{$val->id}}"/>
                    <input type="hidden" name='status' value='0'/>
                    <input type="submit" id="decline" name="DECLINE" style="display: none;" />
                    <label onclick="document.getElementById('decline').click();">DECLINE</label>
                </form>
                <div class="clear"></div>
            </div>
            @endforeach
            <div class="clear"></div>
        </div>
        <div class="submitted-book" style="display: none">
            @foreach($submitted_books as $val)
            <div class=" row item">
                <div class="edit-delete">
                    <div class="edit"><a href="{{ url('books/ebook/'.$val->id.'/'.$val->ebooktitle) }}" target="_blank"><i class="fas fa-eye"></i></a></div>
                </div>
                <div class="image">
                    @if(substr($val->ebook_logo, 0, 4) == "http")
                        <img src="{{ $val->ebook_logo }}" alt="img1" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $val->ebook_logo }}" alt="img1" />
                    @endif
                </div>
                <div class="title">{{ $val->ebooktitle }}: {{$val->subtitle}}</div>
                <div class="writer">@if(isset($val->publisher)){{$val->publisher}}@else Publisher @endif</div>
                <form action="{{ url('admin/books/approve/'.$val->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="book_id" value="{{$val->id}}">
                    <input type="hidden" name='status' value='2'/>
                    <input type="submit" value="APPROVE"/>
                </form>
                <form action="{{ url('admin/books/decline/'.$val->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="book_id" value="{{$val->id}}"/>
                    <input type="hidden" name='status' value='0'/>
                    <input type="submit" id="decline" name="DECLINE" style="display: none;" />
                    <label onclick="document.getElementById('decline').click();">DECLINE</label>
                </form>
                <div class="clear"></div>
            </div>
            @endforeach
            <div class="clear"></div>
        </div>
    </div>
</div>
<!-- end admin listing page-->
@endsection
@section('footer_scripts')
<script type="text/javascript">
	$(".user-sections .unit").click(function(){
		$(".plan-listing").hide();
		$(".user-sections .unit").removeClass("active");
		$(this).addClass("active");
        var dataAttr=$(this).attr("data-attr");
        console.log('dataAttr', dataAttr);
		$(".created-book,.submitted-book").hide();
        $(".created-book,.submitted-book").removeClass("active");
		$("."+dataAttr).show();
        $("."+dataAttr).addClass("active");
		$("."+dataAttr).removeAttr("style");
	});
</script>
<style type="text/css">
    .second-row active{ display: block; }
</style>
@endsection
