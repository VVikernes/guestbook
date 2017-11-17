@extends('base')

@section('title', 'Guestbook')

@section('baseContent')

    @include('flash::message')
    <div class="row">
        {!! BootForm::open(['id' => 'messageForm', 'enctype' => 'multipart/form-data']) !!}
        <div class="col-sm-4 blog-main">
            {!! BootForm::text('username', null, null, ['required', 'pattern' => '^[a-zA-Z\d]+$']) !!}

            {!! BootForm::email('email', null, null, ['required']) !!}

            {!! BootForm::text('homepage') !!}

            {!! BootForm::file('file') !!}

            {!! captcha_img('flat') !!}

            {!! BootForm::text('captcha', null, null, ['required']) !!}

            {!! BootForm::submit('Send') !!}
        </div>
        <div class="col-sm-8 blog-main">
            {!! BootForm::textarea('text', null, null, ['required']) !!}
        </div>
        {!! BootForm::close() !!}
    </div>
    <div class="row">
        @if (count($messages) > 0)
            <table class="table table-bordered">
                <tr>
                    <td>@sortablelink('username', 'Username')</td>
                    <td>@sortablelink('email', 'Email')</td>
                    <td>Homepage</td>
                    <td>@sortablelink('created_at', 'Data added')</td>
                    <td>Message</td>
                </tr>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->username }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->homepage }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>
                            {{ $message->text }}
                            @if(!empty($message->path_to_file))
                                <div>
                                    <a href="{{ asset($message->path_to_file) }}">Attached file</a>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            There is nothing to display here.
        @endif
        {!! $messages->appends(\Request::except('page'))->render() !!}
    </div>
@endsection

@section('javascript')
    <script>
        //        $(document).ready(function () {
        //            $('#messageForm').submit(function (e) {
        //                e.preventDefault(e);
        //
        //                $.ajax({
        //                    type: 'POST',
        //                    url: '/postMessage',
        //                    data: $(this).serialize(),
        //                    dataType: 'json',
        //                    success: function (data) {
        //                        console.log(data);
        //                    },
        //                    error: function (data) {
        //                        alert('An error has occurred');
        //
        //                        console.log(data);
        //                    }
        //                });
        //            });
        //        });
    </script>
@endsection