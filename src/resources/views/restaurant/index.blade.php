@extends('layouts.app')

@section('content_header')
    <h1>Your favorites</h1>
@stop

@push('link')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" />
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manage your favorites</h3>
                <a class="btn btn-sm btn-outline-dark float-right" href="{{ route('restaurant.create') }}">
                    <i class="fa fa-plus" aria-hidden="true">Add</i>
                </a>
            </div>
            <div class="card-body">
                @if ($restaurants->isEmpty())
                    No data
                @else
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Genre</th>
                                <th>Area</th>
                                <th>Your review</th>
                                <th>Google's review</th>
                                <th>Takeaway</th>
                                <th>URL</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $item)
                                <tr>
                                    <td><a href="{{ route('restaurant.edit', $item->id) }}" style="color: black">{{ $item->name }}</a></td>
                                    <td>{{ $item->genre }}</td>
                                    <td>{{ $item->area }}</td>
                                    <td>☆{{ $item->user_review }}</td>
                                    <td>☆{{ $item->google_review }}</td>
                                    <td>
                                        @if ($item->takeaway_flag === App\Enums\TakeawayFlag::Possible->value)
                                            <span class="material-symbols-outlined">
                                                circle
                                            </span>
                                        @elseif ($item->takeaway_flag === App\Enums\TakeawayFlag::Impossible->value)
                                            <span class="material-symbols-outlined">
                                                close
                                            </span>
                                        @else
                                            <span class="material-symbols-outlined">
                                                remove
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->url)
                                            <a href="{{ $item->url }}" target="_blank" rel="noopener" style="color: black">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('restaurant.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('Are you sure to delete?')">
                                                <i class="fa fa-trash" aria-hidden="true" style="color: mediumvioletred;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="paginator">
                    <div class="result">Showing {{ $restaurants->firstItem() }} to {{ $restaurants->lastItem() }} of  {{ $restaurants->total() }} entries</div>
                    <div class="link">{{ $restaurants->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .paginator {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .paginator > .result {
            padding-top: 6px;
        }
        .pagination {
            margin-bottom: 0px;
        }
        .material-symbols-outlined {
            font-size: 16px
        }
    </style>
@endpush
