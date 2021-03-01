@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" enctype="multipart/form-data" action="{{ route('create_image') }}">
            {{-- <form method="POST" enctype="multipart/form-data" action="{{ route('create_image') }}" id="image_form"> --}}
                @csrf
                <div class="form-group row">
                    <label for="image"  class="col-md-4 col-form-label text-md-right"> {{ __('Télécharger une image') }}</label>

                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control-file @error('email') is-invalid @enderror"
                        id="image" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" id="submit_image" class="btn btn-block btn-dark">Valider</button>
                </div>
            </form>

            <div class="card">
                <div class="card-header">{{ __('Pays') }}</div>

                <div class="card-body">
                    @if ($user->picture)
                        <img src="/images/{{ $user->id }}/{{ $user->picture }}" alt="Photo" />
                        {{-- <img class="studentPicture_picture" src="{{ url('/images/' . $user->id . '/' . $user->picture )}}"> --}}
                        {{-- <img class="image" src="{{asset("resources/user_" . $user->id . '/' . $user->picture) }}"> --}}
                        {{-- <img src="{{ URL::to('/') }}images/{{ $user->id }}/{{ $user->picture }}" /> --}}
                    @endif

                    {{-- @foreach ($user->pays as $pay)
                        <div>
                            {{ ucfirst(Lang::get('lang.'. $pay->slug)) }}
                        </div>
                    @endforeach --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script defer src="{{ asset('js/pays.js') }}" ></script>
<script defer src="{{ asset('js/image.js') }}" ></script>

