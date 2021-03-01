@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pays') }}</div>

                <div class="card-body">

                    <form action="{{ route('create_pays') }}" method="POST">
                        @csrf
                        <div class="multiselect form-group{{ $errors->has('pays') ? ' has-error' : '' }}">
                            <div class="selectBox" id="pays">
                                <select class="pays form-control">
                                <option value=""> {{ ucfirst(Lang::get('lang.list_of_countries')) }}*</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div id="funding_checkboxes" class="funding_checkboxes">
                                @foreach ($pays as $pay)
                                    <div>
                                        <label for="{{ $pay->slug }}">
                                            <input type="checkbox" name="pays[]" class="funding_method" id="{{ $pay->slug }}" value="{{ $pay->id  }}"/>
                                            {{ ucfirst(Lang::get('lang.'. $pay->slug)) }}
                                        </label>
                                    </div>
                                @endforeach

                                @if ($errors->has('pays'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pays') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-block btn-dark">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script defer src="{{ asset('js/pays.js') }}" ></script>

