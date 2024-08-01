@extends('layouts.admin')

@section('css')
    <!-- Quill css -->
    <link href="{{ asset('assets/admin') }}/libs/quill/quill.core.js" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin') }}/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin') }}/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Quản lí bài viết
@endsection
@section('content')
    <div class="dashboard-page-content">
        <div class="row mb-9 align-items-center justify-content-between">
            <div class="col-md-6 mb-8 mb-md-0">
                <h2 class="fs-4 mb-0">Danh Mục Bài Viết</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Thêm Danh Mục Bài Viết </h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('baiviets.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tieu_de">Tiêu đề</label>
                                        <input class="form-control" type="text" name="tieu_de" placeholder="Tiêu đề">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bai_viet_id" class="form-label">Danh Mục</label>
                                        <select name="bai_viet_id"
                                            class="form-select @error('bai_viet_id') is-invalid @enderror">
                                            <option value="0">--Chọn Danh Mục--</option>
                                            @foreach ($listDanhMuc as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('bai_viet_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->ten_danh_muc }}</option>
                                            @endforeach
                                        </select>
                                        @error('bai_viet_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="noi_dung">Nội dung</label>
                                        <div id="quill-editor" style="height: 400px;">
                                        </div>
                                        <textarea name="noi_dung" id="noi_dung_content" class="d-none"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Quill Editor Js -->
    <script src="{{ asset('assets/admin') }}/libs/quill/quill.core.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/quill/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",
            })
            // hiển thị nội dung cũ
            var old_content = `{!! old('noi_dung') !!}`;
            quill.root.innerHTML = old_content;

            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('noi_dung_content').value = html;
            })
        })
    </script>
@endsection
