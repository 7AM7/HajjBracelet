@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="card-body">
    <form method="POST" action="{{ route('store.update', request()->route('id')) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-9">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $store->name }}" required>

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
                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $store->description }}</textarea>

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

                 <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $store->mobile }}" required>
                
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
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $store->email }}" required>

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
                <input id="commercial_registration" type="text" class="form-control{{ $errors->has('commercial_registration') ? ' is-invalid' : '' }}" name="commercial_registration" value="{{ $store->commercial_registration }}" required>

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
                <input id="tax_card" type="text" class="form-control{{ $errors->has('tax_card') ? ' is-invalid' : '' }}" value="{{ $store->tax_card }}" name="tax_card" required>

                @if ($errors->has('tax_card'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tax_card') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="balance" class="col-md-3 col-form-label text-md-right">{{ __('Balance') }}</label>

            <div class="col-md-9">
                <input disabled id="tax_card" type="text" class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" value="{{ $store->balance }}" name="balance" required />
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
