@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="/clients/create" role="button" style="float: right; margin: 0 0 15px; border-radius: 0px;">Create Client</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">NationalID</th>
      <th scope="col">Country</th>
      <th scope="col">Balance</th>
      <th scope="col">QR</th>
      <th scope="col">Transactions</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($users as $user)
    <tr>
      <th scope="row">{{ $user->id }}</th>
      <td><img src="{{ $user->image == '' ? 'images/user.png' : $user->image }}" width="50" height="50" style="border-radius:50%" /></td>
      <td>{{ $user->name }}</td>
      <td>{{ '('.$user->country_code.') '.$user->mobile }}</td>
      <td>{{ $user->client->national_id }}</td>
      <td>{{ $user->client->country->name }}</td>
      <td>{{ $user->client->balance }} RAS</td>
      <td><img src="{{ $user->client->qr_code }}" width="50" height="50" /></td>
      <td><a href="clients/{{ $user->id }}/transactions">Trans</a></td>
      <td><a href="clients/{{ $user->id }}/edit">Edit</a></td>
    </tr>
    @endforeach

  </tbody>
</table>

{{ $users->links() }}

@endsection