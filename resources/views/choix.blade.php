@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pays') }}</div>

                <div class="card-body">
                    @foreach ($user->pays as $pay)
                        <div>
                            {{ ucfirst(Lang::get('lang.'. $pay->slug)) }}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script defer src="{{ asset('js/pays.js') }}" ></script>

