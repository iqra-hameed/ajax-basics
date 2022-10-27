@extends('main_body')
@section('main_section')
    <!-- row -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{$url}}" method="post">
                                @csrf
                                @foreach ($labes as $val)


                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Name</label>
                                    <input type="text" name="Lab_name" class="form-control form-control-solid" value="{{$val->Lab_name}}"
                                        placeholder="Enter Lab Name" />
                                        <span class="text-danger">
                                            @error('Lab_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                                <!--begin::Input group-->
                                <label for="exampleFormControlInput1" class="required form-label">Lab Price</label>
                                <div class="input-group input-group-solid mb-5">
                                    <span class="input-group-text">Rs</span>
                                    <input type="number" name="Lab_price" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$val->Lab_price}}" />
                                    <span class="input-group-text">.00</span>
                                    <span class="text-danger">
                                        @error('Lab_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <label for="basic-url" class="required form-label">Lab Address/Location</label>
                                <div class="input-group input-group-solid mb-5">
                                    <span class="input-group-text" id="basic-addon3">Location</span>
                                    <input type="text" class="form-control" name="Lab_location" id="basic-location"
                                        aria-describedby="basic-addon3" value="{{$val->Lab_location}}" />
                                        <span class="text-danger">
                                            @error('Lab_location')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
@endsection
