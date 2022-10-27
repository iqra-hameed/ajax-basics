@extends('main_body')
@section('main_section')
<!-- row -->

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="#" method="post">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Lab Name"/>
                            </div>
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Email</label>
                                <input type="email" class="form-control form-control-solid" placeholder="Enter Lab Email"/>
                            </div>
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Password</label>
                                <input type="password" class="form-control form-control-solid" placeholder="Enter Lab Password"/>
                            </div>
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Confirm Password</label>
                                <input type="Password" class="form-control form-control-solid" placeholder="..and confirm it!"/>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-confirm-password"> <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="..and confirm it!">
                                </div>
                            </div> --}}
                            <div class="input-group">
                                <span class="input-group-text">With textarea</span>
                                <textarea class="form-control" aria-label="With textarea"></textarea>
                            </div>
                            <label for="basic-url" class="form-label">Your vanity URL</label>
<div class="input-group mb-5">
    <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"/>
</div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-currency">Currency <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-currency" name="val-currency" placeholder="$21.60">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-website">Website <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-website" name="val-website" placeholder="http://example.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-phoneus">Phone (US) <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-phoneus" name="val-phoneus" placeholder="212-999-0000">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-digits">Digits <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-digits" name="val-digits" placeholder="5">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-number">Number <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-number" name="val-number" placeholder="5.0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-range">Range [1, 5] <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-range" name="val-range" placeholder="4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><a href="#">Terms &amp; Conditions</a>  <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                        <input type="checkbox" class="css-control-input" id="val-terms" name="val-terms" value="1"> <span class="css-control-indicator"></span> I agree to the terms</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection
