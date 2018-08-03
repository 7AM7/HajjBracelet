@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="/stores/{{ request()->route('id') }}/admins/create" role="button" style="float: right; margin: 0 0 15px; border-radius: 0px;">Create Admin</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
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
      <td><a href="/stores/{{ request()->route('id') }}/admins/{{ $user->id }}/edit">Edit</a></td>
    </tr>
    @endforeach

  </tbody>
</table>

{{ $users->links() }}

@endsection