@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="/clients/{{ request()->route('id') }}/transactions/create" role="button" style="float: right; margin: 0 0 15px; border-radius: 0px;">Create Transaction</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Balance</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($transactions as $transaction)
    <tr>
      <th scope="row">{{ $transaction->id }}</th>
      <td>{{ $transaction->balance }}</td>
      <td>{{ $transaction->type }}</td>
      <td>{{ $transaction->created_at }}</td>
      <td><a href="/clients/{{ request()->route('id') }}/transactions/{{ $transaction->id }}/edit">Edit</a></td>
    </tr>
    @endforeach

  </tbody>
</table>

{{ $transactions->links() }}

@endsection