@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="/transactions/create" role="button" style="float: right; margin: 0 0 15px; border-radius: 0px;">Create Transaction</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User ID</th>
      <th scope="col">Balance</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
      <th scope="col">STATUS</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($transactions as $transaction)
    <tr>
      <th scope="row">{{ $transaction->id }}</th>
      <td>{{ $transaction->user_id }}</td>
      <td>{{ $transaction->balance }}</td>
      <td>{{ $transaction->type }}</td>
      <td>{{ $transaction->created_at }}</td>
      <td id="td{{$transaction->id}}">
        @if($transaction->status == 'PENDING') 
        <button id="{{ $transaction->id }}" onclick="myfunction(this.id)">PENDING</button>
        @else 
        ACCEPTED
        @endif
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

<script type="text/javascript">
  function myfunction(id){
    
    var pincode = prompt("enter pincode");
    if (pincode != null) {

      $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {pincode:pincode},
        url: '/transactions/'+id+'/confirmation',
        success: function(data){
          if(data == "1"){
            $("#td"+id).text('ACCEPTED');
          }
        },
        error: function(){
          alert('failure');
        }
      });

    }

  }
</script>
{{ $transactions->links() }}

@endsection