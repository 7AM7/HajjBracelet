@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="card-body">
    <form method="POST" action="{{ route('userbranchtransaction.store',request()->route('id')) }}" aria-label="{{ __('Login') }}">
        @csrf


        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Client Name') }}</label>

            <div class="col-md-9">
                <input disabled id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $user->name }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('NationalID') }}</label>

            <div class="col-md-9">
                <input disabled id="name" type="text" class="form-control{{ $errors->has('s') ? ' is-invalid' : '' }}" value="{{ $user->client->national_id }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Current Balance') }}</label>

            <div class="col-md-9">
                <input disabled id="name" type="number" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $user->client->balance }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="amount" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>

            <div class="col-md-9">

                <select id="amount" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                    <option value="WITHDRAWAL">Withdrawal</option>
                    <option value="DEPOSIT">Deposit</option>
                </select>

                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group row">
            <label for="amount" class="col-md-3 col-form-label text-md-right">{{ __('Amount') }}</label>

            <div class="col-md-9">
                <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" min="1" value="{{ $user->client->balance }}" required>

                @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('amount') }}</strong>
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
