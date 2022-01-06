@extends('admin.layout.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if(@session('status'))
                    <h4 class="alert alert-warning mb-2">{{session('status')}}</h4>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <h4 class="card-title">This is Menu</h4>
                        </div>
                        <div class="card-content">
                            <a href="{{url('admin/menus/create')}}" class="btn btn-fill btn-rose pull-right">Create Menu</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($menus as $key => $item)
                    <div class="col-md-4">
                        <div class="card card-product">
                            <div class="card-image" data-header-animation="true">
                                <a href="#pablo">
                                    <img class="img img-fluid" style="height: 300px;" src="{{asset('uploads/menus/photo/'.$item['photo'])}}">
                                </a>
                            </div>

                            <div class="card-content">
                                <div class="card-actions">
                                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                        <i class="material-icons">build</i> Fix Header!
                                    </button>

                                    <a href="{{route('menus.edit',$key)}}" type="button" class="btn btn-success btn-simple" rel="tooltip"
                                            data-placement="bottom" title="Edit">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form action="{{route('menus.destroy',$key)}}" method="post" onclick="return confirm('Are you sure?')" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                    <button type="submit" class="btn btn-danger btn-simple" rel="tooltip"
                                            data-placement="bottom" title="Remove">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </form>
                                </div>

                                <h4 class="card-title">
                                    <a href="#pablo">{{$item['name']}}</a>
                                </h4>
                                <div class="card-description">

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="price">
                                    <h4>${{$item['price']}}</h4>
                                </div>
                                <div class="stats pull-right">
                                    <p class="category"><i class="material-icons">phone</i> {{$item['phone']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
