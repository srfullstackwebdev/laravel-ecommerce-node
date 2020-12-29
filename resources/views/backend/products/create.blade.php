@extends('backend.layouts.app')

@section('style')
    <!-- Select2- -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
    <!-- Fileinput -->
    <link href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <h4 class="m-0 font-weight-bold text-success">Add product</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-success">
                        <span class="icon text-primary-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Product</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.products.store','method' => 'post', 'files' => true]) !!}

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Product Name') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('category_id', 'Category') !!}
                        {!! Form::select('category_id', ['' => '---'] + $categories->toArray(), old('category_id'), ['class' => 'form-control']) !!}
                        @error('category_id')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                        @error('description')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('details', 'Details') !!}
                        {!! Form::textarea('details', old('details'), ['class' => 'form-control']) !!}
                        @error('details')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    {!! Form::label('price', 'Price') !!}
                    {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}
                    @error('price')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
                <div class="col-3">
                    {!! Form::label('tags', 'Tag') !!}
                    {!! Form::select('tags[]', [] + $tags->toArray(), old('tags'), ['class' => 'form-control select-multiple-tags', 'multiple' => 'multiple']) !!}
                    @error('tags')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
                <div class="col-3">
                    {!! Form::label('review_able', 'Review able') !!}
                    {!! Form::select('review_able', ['1' => 'Yes', '0' => 'No'], old('review_able'), ['class' => 'form-control']) !!}
                    @error('review_able')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
                <div class="col-3">
                    {!! Form::label('in_stock', 'In stock') !!}
                    {!! Form::number('in_stock', old('in_stock'), ['class' => 'form-control', 'min' => 0]) !!}
                    @error('in_stock')<span class="text-danger">{!!  $message  !!}</span>@enderror
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('Sliders', 'images') !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('images[]', ['id' => 'product-images', 'multiple' => 'multiple', 'class' => 'file-input-overview']) !!}
                        <span class="form-text text-muted">Image width should be 600px x 400px</span>
                        @error('images')<span class="text-danger">{!!  $message  !!}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                        {!! Form::submit('Add product', ['class' => 'btn btn-success']) !!}
                    </div>

            {!! Form::close() !!}
        </div>

    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>

    <script>
        $(function () {
            $('.select-multiple-tags').select2({
            minimumResultsForSearch: Infinity,
            tags: true,
            closeOnSelect: false
            });
        });
    </script>

    <script>
        $(function () {
            $('#product-images').fileinput({
                theme: "fas",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection