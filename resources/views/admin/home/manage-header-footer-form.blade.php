@extends('admin.master')

@section('title','Header & Footer Edit Form')

@section('main-content')
<!--Content Start-->
<section class="container-fluid">
    <div class="row content registration-form">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Header & Footer Edit Form</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('header-footer-update',$headerFooter->id) }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf 

                <div class="form-group col-12 mb-3">
                    <label for="owner_name" class="col-sm-3 col-form-label text-right">Owner Name</label>
                    <input id="owner_name" type="text" class="col-sm-9 form-control @error('owner_name') is-invalid @enderror" name="owner_name" value="{{ $headerFooter->owner_name }}" required autofocus autocomplete="owner_name">
                    @error('owner_name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                
                <div class="form-group col-12 mb-3">
                    <label for="owner_department" class="col-sm-3 col-form-label text-right">Owner Department</label>
                    <input id="owner_department" type="text" class="col-sm-9 form-control @error('owner_department') is-invalid @enderror" name="owner_department" value="{{ $headerFooter->owner_department }}"  required autofocus autocomplete="owner_department">
                    @error('owner_department')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="mobile" class="col-sm-3 col-form-label text-right">Mobile</label>
                    <input id="mobile" type="number" class="col-sm-9 form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $headerFooter->mobile }}"  autocomplete="mobile" required>
                    @error('mobile')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                    <textarea name="address" class="form-control" id="address" cols="73" rows="5"  required>{{ $headerFooter->address }}</textarea>
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="copyright" class="col-sm-3 col-form-label text-right">Copyright</label>
                    <input id="copyright" type="text" class="col-sm-9 form-control @error('copyright') is-invalid @enderror" name="copyright" value="{{ $headerFooter->copyright }}" required>
                    @error('copyright')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <input type="hidden" name="status" value="1">

                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->
</section>
@endsection