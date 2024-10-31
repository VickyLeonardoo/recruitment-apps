@extends('partials.applicant.navbar')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th></th>           
                                <th>Nomor Lamaran</th>          
                                <th>Nomor Pekerjaan</th>          
                                <th>Tanggal Melamar</th>          
                                <th>Status</th>          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apps as $application)
                                <tr>
                                    <td>
                                        <a href="{{ route('applicant.application.show', $application) }}" class="btn btn-dark text-white">Detail</a>
                                    </td>
                                    <td>{{ $application->reg_no }}</td>
                                    <td>{{ $application->job?->code ?? 'N/A' }}</td>
                                    <td>{{ $application->created_at }}</td>
                                    <td>{{ $application->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection