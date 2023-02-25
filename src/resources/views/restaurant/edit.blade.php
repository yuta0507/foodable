@extends('layouts.app')

@section('content_header')
    <h1>Your favorite</h1>
@endsection

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit {{ $restaurant->name }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('restaurant.update', $restaurant->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text" name="name" maxlength="255" value="{{ old('name') ?? $restaurant->name }}"
                                class="form-control form-control-border border-width-2 {{ $errors->first('name') ? 'is-invalid' : '' }}"
                            >
                            @if ($errors->first('name'))
                                <span class="error">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <input
                                type="text" name="genre" maxlength="255" value="{{ old('genre') ?? $restaurant->genre }}"
                                class="form-control form-control-border border-width-2 {{ $errors->first('genre') ? 'is-invalid' : '' }}"
                            >
                            @if ($errors->first('genre'))
                                <span class="error">{{ $errors->first('genre') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="genre">Area</label>
                            <input
                                type="text" name="area" maxlength="255" value="{{ old('area') ?? $restaurant->area }}"
                                class="form-control form-control-border border-width-2 {{ $errors->first('area') ? 'is-invalid' : '' }}"
                            >
                            @if ($errors->first('area'))
                                <span class="error">{{ $errors->first('area') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="user_review">Your review</label>
                            <input
                                type="number" name="user_review" value="{{ old('user_review') ?? $restaurant->user_review }}" min="0" step="0.1" max="5.0"
                                class="form-control form-control-border border-width-2 {{ $errors->first('user_review') ? 'is-invalid' : '' }}"
                            >
                            @if ($errors->first('user_review'))
                                <span class="error">{{ $errors->first('user_review') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="google_review">Google's review</label>
                            <input
                                type="number" name="google_review" value="{{ old('google_review') ?? $restaurant->google_review }}" min="0" step="0.1" max="5.0"
                                class="form-control form-control-border border-width-2 {{ $errors->first('google_review') ? 'is-invalid' : '' }}"
                            >
                            @if ($errors->first('google_review'))
                                <span class="error">{{ $errors->first('google_review') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="takeaway_flag">Takeaway</label>
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio" name="takeaway_flag" value="{{ App\Enums\TakeawayFlag::Possible->value }}" id="possible"

                                    @if (old('takeaway_flag') && (int) old('takeaway_flag') === App\Enums\TakeawayFlag::Possible->value)
                                        {{ 'checked' }}
                                    @elseif ((int) $restaurant->takeaway_flag === App\Enums\TakeawayFlag::Possible->value)
                                        {{ 'checked' }}
                                    @endif
                                >
                                <label for="possible">&nbsp;Possible</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio" name="takeaway_flag" value="{{ App\Enums\TakeawayFlag::Impossible->value }}" id="impossible"

                                    @if (old('takeaway_flag') && (int) old('takeaway_flag') === App\Enums\TakeawayFlag::Impossible->value)
                                        {{ 'checked' }}
                                    @elseif ((int) $restaurant->takeaway_flag === App\Enums\TakeawayFlag::Impossible->value)
                                        {{ 'checked' }}
                                    @endif
                                >
                                <label for="impossible">&nbsp;Impossible</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio" name="takeaway_flag" value="{{ App\Enums\TakeawayFlag::Missing->value }}" id="missing"

                                    @if (old('takeaway_flag') && (int) old('takeaway_flag') === App\Enums\TakeawayFlag::Missing->value)
                                        {{ 'checked' }}
                                    @elseif ((int) $restaurant->takeaway_flag === App\Enums\TakeawayFlag::Missing->value)
                                        {{ 'checked' }}
                                    @endif
                                >
                                <label for="missing">&nbsp;I don't know</label>
                            </div>
                            @if ($errors->first('takeaway_flag'))
                                <span class="error">{{ $errors->first('takeaway_flag') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" value="{{ old('url') ?? $restaurant->url }}" class="form-control form-control-border border-width-2">
                        </div>

                        <button class="btn btn-info" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

