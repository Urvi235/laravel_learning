@extends('user.layout')
@section('content')
<div class="wrapperdiv">
    <div class="formcontainer">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New Campaign</h2>
                </div>
            </div>
        </div>
        @if($messge = Session::get('error'))
            <div class="alert alert-danger text-center">{{ $messge }}</div> 
            @endif

            
        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! There were some problems with your input.</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

       
        
        <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="columnwrap">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-control">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control" />
                            </div>
                        </div>
                    </div>
               
                    <div class="columnwrap">
                        <div class="form-group row">
                            <label for="img" class="col-sm-2 col-form-control">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="img" id="img" class="form-control-file" />
                            </div>
                        </div>
                    </div>

                    <div class="columnwrap">
                        <div class="form-group row">
                            <label for="Description" class="col-sm-2 col-form-control">Description</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="ckeditor form-control" name="description" id="description"></textarea> 
                             </div>   
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"></div>

                        <div class="col-sm-10">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">
                                SAVE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
