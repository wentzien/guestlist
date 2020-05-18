@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="content">

                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="navStart()" style="margin: 20px auto 20px auto; max-width: 700px;">Start</button>
                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="navSettings()" style="margin: 20px auto 20px auto; max-width: 700px">Einstellungen</button>

            </div>

            <script>
                function navStart() {
                    window.location.href = "/welcome";
                }
                function navSettings() {
                    window.location.href = "/settings";
                }
            </script>
        </div>
    </div>
</div>
@endsection
