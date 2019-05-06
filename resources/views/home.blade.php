@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['username'] }}</td>
                                    <td>
                                        <a role="button" href="{{ route('user.show', ['id' => $key]) }}" class="btn btn-success">Show</a>
                                        <button class="btn btn-danger" onclick="deleteUser('{{ $key }}', this)">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        function deleteUser(id, element) {
            if(!confirm('Bạn có muốn xóa người dùng này?')) {
                return;
            }
            $(element).parents('tr').remove();
            $.ajax({
                url: `./user/delete/${id}`,
                method: 'post',
                data: {_method: 'delete', _token: '{{ csrf_token() }}'},
                error: function(data, textStatus, jqXHR) {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection
