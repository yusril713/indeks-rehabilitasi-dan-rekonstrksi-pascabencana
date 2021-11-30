<div>
    <div class="form-group">
        <label for="provinsi" class="col-sm-4 control-label">Provinsi</label>
        <div class="col-sm-8">
            <select class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" wire:model="selectProv">
                <option selected>Pilih Provinsi</option>
                @foreach($countries as $prov)
                    <option value="{{ $prov->id }}" {{ (old('provinsi') == ($prov->id)) ? 'selected' : '' }}>{{ $prov->nama }}</option>
                @endforeach
            </select>
            @error('provinsi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="form-group">
        <label for="kabupaten" class="col-sm-4 control-label">Kabupaten/ Kota</label>
        <div class="col-sm-8">
            <select class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" wire:model="selectKab">
                <option selected>Pilih Kabupaten</option>
                @foreach($listKab as $kab)
                    <option value="{{ $kab->id }}" {{ (old('kabupaten') == ($kab->id)) ? 'selected' : '' }}>{{ $kab->nama }}</option>
                @endforeach
            </select>
            @error('kabupaten')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="kecamatan" class="col-sm-4 control-label">Kecamatan</label>
        <div class="col-sm-8">
            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" wire:model="selectKec">
                <option selected>Pilih Kecamatan</option>
                @foreach($listKec as $kec)
                    <option value="{{ $kec->id }}" {{ (old('kecamatan') == ($kec->id)) ? 'selected' : '' }}>{{ $kec->nama }}</option>
                @endforeach
            </select>
            @error('kecamatan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="kelurahan" class="col-sm-4 control-label">Desa/ Kelurahan</label>
        <div class="col-sm-8">
            <select class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan" wire:model="selectKel">
                <option selected>Pilih Desa</option>
                @foreach($listKel as $kel)
                    <option value="{{ $kel->id }}" {{ (old('kelurahan') == ($kel->id)) ? 'selected' : '' }}>{{ $kel->nama }}</option>
                @endforeach
            </select>
            @error('kelurahan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
