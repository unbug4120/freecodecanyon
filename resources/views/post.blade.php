@extends('layouts.app')
@section('title', 'Tố cáo Scam')
@section('content')
<section class="section section-lg overflow-hidden z-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-5 mb-5 mt-md-0">
                    <h4>Report A Scam</h4>
                </div>
                <form id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mr-lg-5 mb-4 mb-lg-0">
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <label for="default" class="mr-3">Định danh: <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control w-75" placeholder="Ex: Nguyễn Văn A" name="name" require>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <label for="default" class="mr-3">Số điện thoại: </label>
                                <input type="text" class="form-control w-75" placeholder="Ex: 0865487455" name="phone">
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <label for="default" class="mr-3">Số tài khoản: </label>
                                <input type="text" class="form-control w-75" placeholder="Ex: 228631957" name="bank_number">
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <label for="default" class="mr-3">Ngân hàng: </label>
                                <input type="text" class="form-control w-75" placeholder="Ex: VpBank" name="bank">
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <label for="default" class="mr-3">Số tiền chiếm đoạt: <span class="text-danger">(*)</span></label>
                                <input type="number" class="form-control w-75" placeholder="Ex: 1000000" name="scam_value" require>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <label for="default" class="mr-3">Hình ảnh chứng minh: <span class="text-danger">(*)</span></label>
                                <input id="images" type="file" class="form-control w-75" name="images">
                            </div>
                            <div class="gallery"></div>
                            <div class="form-group d-flex justify-content-between mb-2" style="padding-top: 20px;">
                                <label for="textarea" class="mr-3">Link tài khoản (MXH, forum..):</label>
                                <textarea id="textarea" class="form-control w-75" cols="30" rows="10" placeholder="Mỗi tài khoản viết 1 dòng..." name="link"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-between mb-2">
                                <label for="textarea" class="mr-3">Mô tả đầy đủ:</label>
                                <textarea id="textarea" class="form-control w-75" cols="30" rows="10" placeholder="Mô tả về quá trình scam..." name="description"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-end mb-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-x"></span>
                                        <span class="form-check-sign"></span>
                                        Tôi cam kết những thông tin bên trên là hoàn toàn chính xác và sẽ chịu mọi trách nhiệm về những thông tin mình cung cấp
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex">
                                    <button class="btn btn-sm mr-3 btn-primary border-dark" type="submit">
                                        <span class="btn-text">Submit</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <span class="btn-text">Cancel</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@push('script')
<script>
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img width="200" height="150" style="margin: 10px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };
        var x = 0;
        $('#images').on('change', function() {
            imagesPreview(this, 'div.gallery');
            var formData = new FormData();
            let TotalImages = $('#images')[0].files.length; //Total Images
            let images = $('#images')[0];
            for (let i = 0; i < TotalImages; i++) {
                formData.append('images' + x, images.files[i]);
            }
            formData.append('TotalImages', x + 1);
            $('#form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "/report",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            x = x + 1;
        });
        //
    });
</script>
@endpush
@endsection