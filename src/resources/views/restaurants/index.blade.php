@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Your favorites</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manage your favorites</h3>
            </div>
            <div class="card-body">
                @if ($restaurants->isEmpty())
                    No data
                @else
                    <table class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Takeaway</th>
                                <th>Your review</th>
                                <th>Google's review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->url)
                                            <a href="{{ $item->url }}" target="_blank" rel="noopener" style="color: black">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->takeaway_flag === App\Enums\TakeawayFlag::Possible->value)
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        @elseif ($item->takeaway_flag === App\Enums\TakeawayFlag::Impossible->value)
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td><i class="fa fa-star"></i>{{ $item->user_review }}</td>
                                    <td><i class="fa fa-star" aria-hidden="true"></i>{{ $item->google_review }}</td>
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
@stop

@push('css')
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
</style>
@endpush
