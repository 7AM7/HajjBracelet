@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="card-body">
    <form method="POST" action="{{ route('store.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-9">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-9">
                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"></textarea>

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="image" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>

            <div class="col-md-9">

                 <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                
                @if ($errors->has('image'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('Mobile') }}</label>

            <div class="col-md-9">

                 <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>
                
                @if ($errors->has('mobile'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

            <div class="col-md-9">
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group row">
            <label for="commercial_registration" class="col-md-3 col-form-label text-md-right">{{ __('Commercial Registration') }}</label>

            <div class="col-md-9">
                <input id="commercial_registration" type="text" class="form-control{{ $errors->has('commercial_registration') ? ' is-invalid' : '' }}" name="commercial_registration" required>

                @if ($errors->has('commercial_registration'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('commercial_registration') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="tax_card" class="col-md-3 col-form-label text-md-right">{{ __('Tax Card') }}</label>

            <div class="col-md-9">
                <input id="tax_card" type="text" class="form-control{{ $errors->has('tax_card') ? ' is-invalid' : '' }}" name="tax_card" required>

                @if ($errors->has('tax_card'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tax_card') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <br>
        <hr>
        <br>

        <div class="form-group row">
            <label for="user_name" class="col-md-3 col-form-label text-md-right">{{ __('Admin Name') }}</label>

            <div class="col-md-9">
                <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" required>

                @if ($errors->has('user_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group row">
            <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('Admin Mobile Number') }}</label>

            <div class="col-md-9">

                <select id="mobile" class="form-control{{ $errors->has('user_country_code') ? ' is-invalid' : '' }}" name="user_country_code" value="{{ old('user_country_code') }}" required style="width:80px; float:left;">
                    <option value="+966">+966</option>
                    <option value="+20">+20</option>
                </select>

                 <input style="float:right; width:calc(100% - 90px)" id="user_mobile" type="text" class="form-control{{ $errors->has('user_mobile') ? ' is-invalid' : '' }}" name="user_mobile" value="{{ old('user_mobile') }}" required>

                <div style="clear:both"></div>
                 
                @if ($errors->has('user_country_code'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_country_code') }}</strong>
                    </span>
                @endif
                
                @if ($errors->has('user_mobile'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>



		<div class="form-group row">
            <label for="balance" class="col-md-3 col-form-label text-md-right"></label>

            <div class="col-md-9">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>

        </div>

        



    </form>
</div>
@endsection
