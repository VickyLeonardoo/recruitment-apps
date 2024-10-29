@extends('partials.applicant.navbar')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Code</th>          
                                <th>Position</th>          
                                <th>Status</th>
                                <th>End Registration</th>
                                <th></th>          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->code }}</td>
                                    <td>{{ $job->position->name }}</td>
                                    <td>{{ $job->status }}</td>
                                    <td>{{ $job->end_date }}</td>
                                    <td>
                                        <a class="btn btn-secondary mt-3" href="{{ route('applicant.job.show',$job) }}">Detail</a>
                                        {{-- <a class="btn btn-secondary mt-3" href="{{ route('applicant.job.detail', $job->code) }}">Detail</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection