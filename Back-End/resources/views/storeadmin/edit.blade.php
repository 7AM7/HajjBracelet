@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="card-body">
    <form method="POST" action="/stores/{{ request()->route('id') }}/admins/{{ request()->route('adminId') }}/update">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-9">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

            <div class="col-md-9">

                <select id="mobile" class="form-control{{ $errors->has('country_code') ? ' is-invalid' : '' }}" name="country_code" required style="width:80px; float:left;">
                    <option {{ $user->country_code == '+966' ? 'selected' : '' }} value="+966">+966</option>
                    <option {{ $user->country_code == '+966' ? 'selected' : '' }} value="+20">+20</option>
                </select>

                 <input style="float:right; width:calc(100% - 90px)" id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $user->mobile }}" required>

                <div style="clear:both"></div>
                 
                @if ($errors->has('country_code'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country_code') }}</strong>
                    </span>
                @endif
                
                @if ($errors->has('mobile'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group row">
            <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Role') }}</label>

            <div class="col-md-9">

                <select id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required>
                    <option value="ADMIN">Admin</option>
                    <option value="SUPER_ADMIN">Super Admin</option>
                </select>

                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
                
            </div>
        </div>



		<div class="form-group row">
            <label for="balance" class="col-md-3 col-form-label text-md-right"></label>

            <div class="col-md-9">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>

        



    </form>
</div>
@endsection
