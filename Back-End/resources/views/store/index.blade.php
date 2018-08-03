@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="/stores/create" role="button" style="float: right; margin: 0 0 15px; border-radius: 0px;">Create Store</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Email</th>
      <th scope="col">Balance</th>
      <th scope="col">Transactions</th>
      <th scope="col">Admins</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($stores as $store)
    <tr>
      <th scope="row">{{ $store->id }}</th>
      <td><img src="{{ $store->image == '' ? 'images/user.png' : $store->image }}" width="50" height="50" style="border-radius:50%" /></td>
      <td>{{ $store->name }}</td>
      <td>{{ $store->mobile }}</td>
      <td>{{ $store->email }}</td>
      <td>{{ $store->balance }}</td>
      <td><a href="stores/{{ $store->id }}/transactions">Transactions</a></td>
      <td><a href="stores/{{ $store->id }}/admins">Admins</a></td>
      <td><a href="stores/{{ $store->id }}/edit">Edit</a></td>
    </tr>
    @endforeach

  </tbody>
</table>

{{ $stores->links() }}

@endsection