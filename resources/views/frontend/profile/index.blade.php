@extends('partials.applicant.navbar')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.overview.show') }}" class="nav-link {{ Route::is('applicant.profile.overview.show') ? 'active':'' }}" >Overview</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.show.info') }}" class="nav-link {{ Route::is('applicant.profile.show.info') ? 'active':'' }}" >My Information</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.education.show') }}" class="nav-link {{ Route::is('applicant.profile.education.show') ? 'active':'' }}" >Pendidikan</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.experience.show') }}" class="nav-link {{ Route::is('applicant.profile.experience.show*') ? 'active':''}}">Pengalaman</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.skill.show') }}" class="nav-link {{ Route::is('applicant.profile.skill.show*') ? 'active':''}}">Keahlian</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.language.show') }}" class="nav-link {{ Route::is('applicant.profile.language.show*') ? 'active':''}}">Language</a>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-edit pt-3" id="informasi-pribadi">
                        @yield('tab')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
