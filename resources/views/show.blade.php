@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Thông Tin User</div>

                <div class="card-body">
                    <div>
                        <table>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user['name'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $user['username'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        @foreach ($user as $userKey => $userValue)
                            @if(
                                $userKey == 'keyword' ||
                                $userKey == 'title' ||
                                $userKey == 'totalTime'
                            )
                                <h4>{{ $userKey }}</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 170px;">Thời Gian</th>
                                            <th style="width: 700px">{{ $userKey }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user[$userKey] as $keyword => $keywordValue)
                                            @foreach ($keywordValue as $key => $value)
                                                <tr>
                                                    <td>{{ $key }}</td>
                                                    <td class="value">
                                                        <span class="showValue">{{ $value }}</span>
                                                        <input style="width: 700px" type="text" name="value" value="{{ $value }}" class="editValue d-none">
                                                    </td>
                                                    <td class="showing">
                                                        <button role="button" class="btnEdit btn btn-primary" onclick="editting(this)">Edit</button>
                                                        <button class="btnDelete btn btn-danger"
                                                            onclick="deleteKey(this, '{{ $userKey }}', '{{ $keyword }}')">
                                                            Delete
                                                        </button>
                                                    </td>
                                                    <td class="editting d-none">
                                                        <button
                                                            class="btnSave btn btn-success"
                                                            onclick="showing(
                                                                this,
                                                                true,
                                                                '{{ $userKey }}',
                                                                '{{ $keyword }}',
                                                                '{{ $key }}'
                                                                )">
                                                            Save
                                                        </button>
                                                        <button class="btnCancel btn btn-danger" onclick="showing(this)">Cancel</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        function saveEdit(userKey, keyword, key, value) {
            $.ajax({
                type: 'post',
                url: '',
                data: {_method: 'put', type: userKey, key: keyword, time: key, value: value, _token: '{{ csrf_token() }}'},
                success: function(result) {
                }
            })
        }

        function deleteKey(element, userKey, keyword) {
            if(!confirm('Bạn có muốn xóa?')) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '',
                data: {_method: 'delete', _token: '{{ csrf_token() }}', type: userKey, key: keyword},
                success: function(result) {
                },
                error: function(data, textStatus, jqXHR) {
                    alert(data.error);
                }
            })
            $(element).parents('tr').remove()
        }

        function showing(element, save, userKey, keyword, key) {
            let valueEle = $(element).parents('.editting').siblings('.value').children('.showValue');
            let editEle = $(element).parents('.editting').siblings('.value').children('input');
            $(valueEle).removeClass('d-none');
            if(save) {
                $(valueEle).text($(editEle).val());
                saveEdit(userKey, keyword, key, $(editEle).val());
            } else {
                $(editEle).val($(valueEle).text());
            }
            $(editEle).addClass('d-none');
            $(element).parents('.editting').addClass('d-none');
            $(element).parents('.editting').prev('.showing').removeClass('d-none');
        }
        function editting(element) {
            $(element).parents('.showing').addClass('d-none');
            $(element).parents('.showing').next().removeClass('d-none');
            $(element).parents('td').prev().children('.showValue').addClass('d-none');
            $(element).parents('td').prev().children('input').removeClass('d-none');
        }
    </script>
@endsection
