@extends('layouts.admin')
@section('content')
<!-- book category page-->
<div class="admin-book-category">
    <div class="first-row">
        <div class="user-sections">
            <div class="unit active" data-attr="user-general">
                <a href="#">Created books</a>
            </div>
            <div class="unit" data-attr="user-password">
                <a href="#">submitted books</a>
            </div>
        </div>
    </div>
    <div class="second-row">
        <div class="created-book">
        	@foreach($books as $val)
            <div class=" row item">
                <div class="edit-delete">
                    <div class="edit"><i class="fas fa-eye"></i></div>
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
                    {{ method_field('PATCH') }} {{ csrf_field() }}
                    <input type="hidden" name="status" value="1">
                    <input type="submit" value="APPROVE"/>
                </form>
                <label>DECLINE</label>
            </div>
            @endforeach
        </div>
        <div class="submitted-book">
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
		$(".user-general,.user-password,.user-subscription").removeClass("active");
		$("."+dataAttr).addClass("active");
		$("."+dataAttr).removeAttr("style");
	});
</script>
@endsection
