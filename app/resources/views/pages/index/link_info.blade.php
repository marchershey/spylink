@extends('layouts.index.app')
@section('content')
<section class="jumbotron text-center bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="font-weight-bold">{{$link->lid}}</h1>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Destination
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-truncate">
                                                    {!!$link->page_title!!}
                                                </div>
                                                <p class="small text-muted text-truncate">{{$link->url}}</p>
                                                <p class="text-muted small">
                                                    Created: {{ date('M j Y, g:i A', strtotime($link->created_at))}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Visits
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <p>{{$link->visits}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Referrers
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{$visits->countBy('referrer')->count()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Browsers
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{$visits->countBy('browser')->count()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <table id="table_id" class="table table-hover table-borderless table-sm text-truncate mw-100">
                                    <thead>
                                        <tr>
                                            <th>IP Address</th>
                                            <th>Referrer</th>
                                            <th>Browser</th>
                                            <th>Platform</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($visits) > 0)
                                        @foreach($visits as $visit)
                                        <tr>
                                            <td>{{$visit->ip}}</td>
                                            <td class="text-truncate">{{$visit->referrer}}</td>
                                            <td>{{$visit->browser}}</td>
                                            <td>{{$visit->platform}}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">
                                                No data to display
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <script>
                                    $(document).ready( function () {
                                        $('#table_id').DataTable({
                                            
                                        });
                                    } );
                                </script>
                            </div>
                        </div>
                        <hr>
                        <p class="small text-muted">Link #{{$link->id}} was created by an anonymous user.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection