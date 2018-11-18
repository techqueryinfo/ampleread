@extends('layouts.app')
@section('template_title')Category @endsection
@section('template_fastload_css') @endsection
@section('content')
    <div class="row">
        <div class="col-md-12"><br></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 style="text-align: center; padding: 0 0 40px 0;">Browse Category</h3>
            <section class="links-container browse clearer">
                <ul>
                    @foreach ($categories as $optionKey => $optionValue) @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li>
                        <h3><a style="color:#69737b; font-family: Lato,sans-serif;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></h3>
                        <ul>
                            <?php
                            $b = $optionValue->id;
                            $subcategory = DB::select("select * from categories where status='Active' && parent='$b' && is_delete='0'");
                            foreach ($subcategory as $sKey => $sValue){
                            ?>
                            <li><a href="/books/category/{{$optionValue->category_slug}}/{{$sValue->category_slug}}">{{$sValue->name}}</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                
                    @endif @endforeach
                </ul>
            </section>
        </div>
    </div>
@endsection
