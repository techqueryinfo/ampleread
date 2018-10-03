@extends('layouts.app') @section('template_fastload_css') @endsection @section('content')
<div class="createbook-book">
<div class="createbook-text">
    <div class="heading">Create Your Own eBook</div>
    <div class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit, donec et quam id nunc finibus efficitur molestie</div>
    <div class="createbook-button">
        <button data-toggle="modal" data-target="#createbookModal">Get started</button>
    </div>
</div>
</div>
<!-- modal -->
<div id="createbookModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">eBook info</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-createbook-modal-subheading">Please fill in general information about your eBook. You can edit this info later.</div>
                    <div class="crate-switch">
                        <div class="text">Count Words Automatically</div>
                        <div class="switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="ample-login-section">
                        <form action="{{ url('/book') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="unit1">
                                <div class="form-group">
                                    <div class="heading">eBook Title</div>
                                    <input type="text" id="ebook" name="ebooktitle" required="required" placeholder="eBook Title" />
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}" />
                                </div>
                            </div>
                            <div class="unit2">
                                <div class="form-group">
                                    <div class="heading">Sub Title</div>
                                    <input type="text" id="subtitle" name="subtitle" required="required" placeholder="Sub title" />
                                </div>
                            </div>
                            <div class="unit1" style="display: none;">
                                <div class="form-group">
                                    <div class="heading">eBook Type</div>
                                </div>
                                <select class="js-example-basic-single" name="type" id="type">
                                    <option value="paid">Paid</option>
                                    <option value="free" selected="selected">Free</option>
                                </select>
                            </div>
                            <div class="unit2">
                                <div class="form-group">
                                    <div class="heading">Category</div>
                                </div>
                                <select class="js-example-basic-single" id="category" name="category">
                                    @if(!$categories->isEmpty())
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" name="status" value="0"/>
                            </div>
                            <div class="form-group">
                                <div class="heading">Description</div>
                                <textarea name="desc" class="form-control" rows="5" id="comment" placeholder="Enter Description..." required="required"></textarea>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <input type="file" name="ebook_logo">
                                    <br/> @if ($item->ebook_logo)
                                    <div class="col-md-2">
                                        <img src="/uploads/ebook_logo/{{ $setting->ebook_logo }}" width="80px" />
                                    </div>
                                    @endif
                                    <button type="submit" class="submit-button">Create Ebook</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection @section('footer_scripts') @endsection