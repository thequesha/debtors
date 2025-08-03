<div class="row">
    <div class="form-group mb-2 col-4 ">
        <input type="text" name="name" id="name"
            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ request('name') }}"
            placeholder="Поиск по имени">
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    </div>
    <div class="form-group mb-2 col-4 ">
        <input type="text" name="surname" id="surname"
            class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" value="{{ request('surname') }}"
            placeholder="Поиск по фамилии">
        <div class="invalid-feedback">{{ $errors->first('surname') }}</div>
    </div>

    <div class="form-group mb-2 col-4 ">
        <input type="text" name="middle_name" id="middle_name"
            class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}"
            value="{{ request('middle_name') }}" placeholder="Поиск по отчеству">
        <div class="invalid-feedback">{{ $errors->first('middle_name') }}</div>
    </div>

</div>
