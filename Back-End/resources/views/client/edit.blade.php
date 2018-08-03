@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="card-body">
    <form method="POST" action="{{ route('client.update', request()->route('id')) }}" aria-label="{{ __('Login') }}">
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
                    <option {{ $user->country_id == '+966' ? 'selected' : ''  }} value="+966">+966</option>
                    <option {{ $user->country_id == '+20' ? 'selected' : ''  }} value="+20">+20</option>
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
            <label for="national_id" class="col-md-3 col-form-label text-md-right">{{ __('NationalID') }}</label>

            <div class="col-md-9">
                <input id="national_id" type="text" class="form-control{{ $errors->has('national_id') ? ' is-invalid' : '' }}" name="national_id" value="{{ $user->client->national_id }}" required>

                @if ($errors->has('national_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('national_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="country_id" class="col-md-3 col-form-label text-md-right">{{ __('Country') }}</label>

            <div class="col-md-9">
                <select id="country_id" class="form-control{{ $errors->has('country_id') ? ' is-invalid' : '' }}" name="country_id" value="{{ old('country_id') }}" required>
                	@foreach($countries as $country)
                    <option {{ $country->id == $user->client->country_id ? 'selected' : ''  }} value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('country_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="balance" class="col-md-3 col-form-label text-md-right">{{ __('Balance') }}</label>

            <div class="col-md-9">
                <input id="balance" type="text" class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ $user->client->balance }}" required>

                @if ($errors->has('balance'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('balance') }}</strong>
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
