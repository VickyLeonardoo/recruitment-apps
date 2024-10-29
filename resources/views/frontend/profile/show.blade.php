@extends('frontend.profile.index')
@section('tab')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('applicant.profile.update', auth()->user()->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="onlybottom" placeholder="" value="{{ auth()->user()->name ?? '' }}"
                        name="name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="">No. NIK</label>
                    <input type="text" class="onlybottom" placeholder="" value="{{ auth()->user()->identity_no ?? '' }}"
                        name="identity_no">
                    @error('identity_no')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="onlybottom" placeholder="" value="{{ auth()->user()->dob ?? '' }}"
                        name="dob">
                    @error('dob')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group mb-3">
                    <label for="">Jenis Kelamin</label>
                    <select class="onlybottom" aria-label="Default select example" name="gender">
                        <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Laki -
                            Laki</option>
                        <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Kota</label>
                    <input type="text" class="onlybottom" placeholder="Masukkan kota domisili anda"
                        value="{{ auth()->user()->city }}" name="city">
                    @error('city')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" class="removall" placeholder="" value="{{ auth()->user()->email }}"
                        name="email" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="">Nomor Ponsel</label>
                    <input type="text" class="onlybottom" placeholder="" value="{{ auth()->user()->phone ?? '' }}"
                        name="phone">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Agama</label>
                    <select class="onlybottom" aria-label="Default select example" name="religion">
                        <option value="islam" {{ auth()->user()->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="kristen" {{ auth()->user()->religion == 'kristen' ? 'selected' : '' }}>Kristen
                        </option>
                        <option value="hindu" {{ auth()->user()->religion == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="budha" {{ auth()->user()->religion == 'budha' ? 'selected' : '' }}>Budha</option>
                        <option value="konghuchu" {{ auth()->user()->religion == 'konghuchu' ? 'selected' : '' }}>Konghuchu
                        </option>
                    </select>
                    @error('religion')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select class="onlybottom" aria-label="Default select example" name="status">
                        <option value="" disabled selected>-- Pilih Status --</option>
                        <option value="Menikah" {{ auth()->user()->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Belum Menikah" {{ auth()->user()->status == 'Belum Menikah' ? 'selected' : '' }}>Belum
                            Menikah</option>
                        <option value="Janda" {{ auth()->user()->status == 'Janda' ? 'selected' : '' }}>Janda</option>
                        <option value="Duda" {{ auth()->user()->status == 'Duda' ? 'selected' : '' }}>Duda</option>
                        <option value="Cerai" {{ auth()->user()->status == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                        <option value="Bercerai" {{ auth()->user()->status == 'Bercerai' ? 'selected' : '' }}>Bercerai
                        </option>
                        <option value="Bercerai Mati" {{ auth()->user()->status == 'Mati' ? 'selected' : '' }}>Bercerai Mati
                        </option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Kewarganegaraan</label>
                    <select name="nationality" class="onlybottom">
                        <option value="Singapore">Indonesia</option>
                        <option value="Indonesia">Singapore</option>
                    </select>
                    @error('nationality')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="form-group mb-3">
                <label for="">Alamat</label>
                <textarea name="address" style="height: 60px" class="onlybottom">{{ auth()->user()->address }}</textarea>
                @error('address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-secondary">
            </div>
        </div>
    </form><!-- End Profile Edit Form -->
@endsection
