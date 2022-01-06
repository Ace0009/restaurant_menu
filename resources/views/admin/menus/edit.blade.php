@extends('admin.layout.master')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/file-input/dist/image-uploader.min.css')}}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <h4 class="card-title">Edit Menu</h4>
                        </div>
                        <br><br>
                        <div class="card-content">
                            <form method="post" action="{{route('menus.update',$id)}}" enctype="multipart/form-data" id="form">
                                @csrf
                                @method('put')
                                <div class="form-group label-floating">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$menu['name']}}" required>
                                </div>
                                <br>
                                <div class="form-group label-floating">
                                    <label class="control-label">Price</label>
                                    <input type="number" class="form-control" name="price" value="{{$menu['price']}}" required>
                                </div>
                                <br>
                                <div class="form-group label-floating">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="{{$menu['phone']}}" required>
                                </div>
                                <br>
                                <div class="form-group label-floating">
                                    <div class="inputPic" style="padding-top: .5rem;"></div>
                                </div>
                                <button type="submit" class="btn btn-fill btn-rose pull-right">Submit</button>
                                <a href="{{url('admin/menus')}}" class="btn btn-fill btn-primary pull-right">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/file-input/src/image-uploader.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/file-input/dist/image-uploader.min.js')}}" type="text/javascript"></script>
    <script>
        document.getElementsByTagName("body")[0].setAttribute("onload", "loadPic()");
        function loadPic() {
            let titleImg = "{{$menu['photo']}}";
            let titlePath = "{{asset('uploads/menus/photo/')}}";
            let titlePreload = [];

            for (let tmpImg of titleImg.split(',')){
                titlePreload.push({id: tmpImg, src: titlePath +"/"+tmpImg});
            }

            $('.inputPic').imageUploader({
                preloaded: titlePreload,
                imagesInputName: 'photo',
                preloadedInputName: 'old_photo',
                extensions: ['.jpg','.jpeg','.png'],
                mimes: ['image/jpeg','image/png'],
                maxFiles: 1,
                label:'Click to choose photo'
            });
        }
    </script>
@stop
