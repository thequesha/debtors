 @php
     $inputName = $inputName ?? '';
     $attrName = $attrName ?? '';
     $attrValue = $attrValue ?? '';
     $label = $label ?? '';
     $required = $required ?? false;
     $type = $type ?? 'text';
     $inputId = $inputId ?? '';
     $min = $min ?? false;
     $max = $max ?? false;
     $maxlength = $maxlength ?? false;
     $placeholder = $placeholder ?? '';
     $class = $class ?? '';
 @endphp

 <div class="mb-3">
     <label for="{{ $inputId }}" class="form-label">
         {{ $label }}
         @if ($required)
             <span class="required">*</span>
         @endif
     </label>
     <input type="{{ $type }}"
         class="form-control {{ $errors->has($inputName) ? 'is-invalid' : '' }} {{ $class }}"
         @if ($maxlength) maxlength="{{ $maxlength }}" @endif
         @if ($min !== false) min="{{ $min }}" @endif
         @if ($max !== false) max="{{ $max }}" @endif name="{{ $inputName }}"
         placeholder="{{ $placeholder }}" value="{{ old($attrName, $attrValue) }}"
         @if ($required) required @endif id="{{ $inputId }}"
         @if ($type === 'password') autocomplete="new-password" @endif
         @if ($attrName === 'username') autocomplete="username" @endif
         @if ($inputName === 'phone') data-inputmask="'mask': '+7 999 9999999'" @endif
         @if ($inputName === 'owner_phone') data-inputmask="'mask': '+7 999 9999999'" @endif
         @if ($inputName === 'owner_name') data-inputmask="'regex': '[а-яА-Я ]+'" @endif
         @if ($inputName === 'owner_surname') data-inputmask="'regex': '[а-яА-Я ]+'" @endif
         @if ($inputName === 'vin') data-inputmask="'regex': '^[A-Za-z0-9]{17}$'" @endif
         @if ($inputName === 'mileage') data-inputmask="'mask': '9{1,7}', 'numeric': true" @endif
         @if ($inputName === 'licence_plate') data-inputmask="'mask': 'A999AA999'" @endif
         @if ($inputName === 'vrc') data-inputmask="'mask': '9999999999'" @endif
         @if ($inputName === 'in_exploitation_since') data-inputmask="'mask': '9999'" @endif
         @if ($inputName === 'vp_available_place_count') data-inputmask="'mask': '9'" @endif
         @if ($inputName === 'vp_owners_count') data-inputmask="'regex': '^(?:[0-9]|[1-9][0-9])$'" @endif
         @if ($inputName === 'duration') data-inputmask="'mask': '9{1,7}', 'numeric': true" @endif
         @if ($inputName === 'stocked_at') data-inputmask="'mask': '99/99/9999'" @endif
         @if ($inputName === 'arrived_at') data-inputmask="'mask': '99/99/9999'" @endif
         @if ($inputName === 'sale_started_at') data-inputmask="'mask': '99/99/9999'" @endif
         @if ($inputName === 'year') data-inputmask="'mask': '9999'" @endif>

     @if ($errors->has($inputName))
         <div class="invalid-feedback">
             {{ $errors->first($inputName) }}
         </div>
     @endif
 </div>

 @if ($inputName === 'phone')
     @push('js')
         <script>
             $(function() {
                 $('#{{ $inputId }}').inputmask();
             });
         </script>
     @endpush
 @endif
