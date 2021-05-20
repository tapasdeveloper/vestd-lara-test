@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class', 'alert-success') }}" role="alert">
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <div class="row">
                        <div class="col-md-12" style="margin: 10px 0;">
                            <button class="btn btn-primary" id="btn_archive" type="button">Create Archive</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#btn_archive').bind({
            click: function() {
                window.location.href = "{{ route("create.archive") }}";
            }
        });
    });
</script>
@endsection