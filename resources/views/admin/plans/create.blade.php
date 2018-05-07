@extends('layouts.admin')

@section('content')
        <div class="row">
            <!-- @include('admin.sidebar') -->

            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/plans') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.plans.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
