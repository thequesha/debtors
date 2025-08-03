@php
    $inputName = $inputName ?? 'car_id';
    $attrName = $attrName ?? 'car_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Автомобиль';
    $required = $required ?? true;
    $inputId = $inputId ?? 'car_id';
@endphp

<div class="mb-3">
    <label for="{{ $inputId }}">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <select name="{{ $inputName }}" id="{{ $inputId }}"
        class="form-control {{ $errors->has($attrName) ? 'is-invalid' : '' }}" {{ $required ? 'required' : '' }}>
        <option value="">Выберите автомобиль</option>
        @foreach ($cars as $car)
            <option value="{{ $car->id }}" {{ $car->id == old($attrName, $attrValue) ? 'selected' : '' }}
                data-full-name="{{ $car->getFullName() }}" data-vin="{{ $car->vin ?? '' }}"
                data-year="{{ $car->year ?? '' }}" data-mileage="{{ $car->mileage ?? '' }}"
                data-color="{{ $car->color->name ?? '' }}" data-purchase_price="{{ $car->purchase_price ?? '' }}"
                data-sell_price="{{ $car->sell_price ?? '' }}" data-engine-type="{{ $car->engine_type ?? '' }}"
                data-transmission-type="{{ $car->transmission_type ?? '' }}"
                data-drive-type="{{ $car->drive_type ?? '' }}" data-body-type="{{ $car->bodyType->name ?? '' }}">
                {{ $car->getFullName() }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>

    <!-- Car Information Card - Hidden by default -->
    <div id="{{ $inputId }}_info" class="car-info-card mt-3" style="display: none;">
        <div class="car-info-table">
            <div class="row">
                <div class="col-md-6">
                    <div id="{{ $inputId }}_vin_container" class="car-info-row">
                        <div class="car-info-label">VIN:</div>
                        <div class="car-info-value" id="{{ $inputId }}_vin"></div>
                    </div>
                    <div id="{{ $inputId }}_year_container" class="car-info-row">
                        <div class="car-info-label">Год выпуска:</div>
                        <div class="car-info-value" id="{{ $inputId }}_year"></div>
                    </div>
                    <div id="{{ $inputId }}_mileage_container" class="car-info-row">
                        <div class="car-info-label">Пробег:</div>
                        <div class="car-info-value" id="{{ $inputId }}_mileage"></div>
                    </div>
                    <div id="{{ $inputId }}_color_container" class="car-info-row">
                        <div class="car-info-label">Цвет кузова:</div>
                        <div class="car-info-value" id="{{ $inputId }}_color"></div>
                    </div>
                    <div id="{{ $inputId }}_engine_type_container" class="car-info-row">
                        <div class="car-info-label">Тип двигателя:</div>
                        <div class="car-info-value" id="{{ $inputId }}_engine_type"></div>
                    </div>
                    <div id="{{ $inputId }}_purchase_price_container" class="car-info-row">
                        <div class="car-info-label">Цена закупки:</div>
                        <div class="car-info-value" id="{{ $inputId }}_purchase_price"></div>
                    </div>
                    <div id="{{ $inputId }}_sell_price_container" class="car-info-row">
                        <div class="car-info-label">Цена продажи:</div>
                        <div class="car-info-value" id="{{ $inputId }}_sell_price"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="{{ $inputId }}_transmission_type_container" class="car-info-row">
                        <div class="car-info-label">Коробка передач:</div>
                        <div class="car-info-value" id="{{ $inputId }}_transmission_type"></div>
                    </div>
                    <div id="{{ $inputId }}_drive_type_container" class="car-info-row">
                        <div class="car-info-label">Привод:</div>
                        <div class="car-info-value" id="{{ $inputId }}_drive_type"></div>
                    </div>
                    <div id="{{ $inputId }}_body_type_container" class="car-info-row">
                        <div class="car-info-label">Тип кузова:</div>
                        <div class="car-info-value" id="{{ $inputId }}_body_type"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .car-info-table {
            width: 100%;
        }

        .car-info-row {
            display: flex;
            margin-bottom: 10px;
        }

        .car-info-label {
            color: #6c757d;
            width: 150px;
            font-size: 14px;
        }

        .car-info-value {
            font-weight: 500;
            font-size: 14px;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Get initial car info if a car is already selected
            updateCarInfo($('#{{ $inputId }}'));

            // Update car info when car selection changes
            $('#{{ $inputId }}').on('change', function() {
                updateCarInfo($(this));
            });

            function updateCarInfo(selectElement) {
                const selectedOption = selectElement.find('option:selected');
                const carId = selectedOption.val();

                if (carId) {
                    // Get data from the selected option's data attributes
                    const fullName = selectedOption.data('full-name');
                    const year = selectedOption.data('year');
                    const mileage = selectedOption.data('mileage');
                    const color = selectedOption.data('color');
                    const engineType = selectedOption.data('engine-type');
                    const transmissionType = selectedOption.data('transmission-type');
                    const driveType = selectedOption.data('drive-type');
                    const bodyType = selectedOption.data('body-type');
                    const vin = selectedOption.data('vin');
                    const purchasePrice = selectedOption.data('purchase-price');
                    const sellPrice = selectedOption.data('sell-price');

                    // Update visibility and content for each field
                    updateField('{{ $inputId }}_year', year, '{{ $inputId }}_year_container');
                    updateField('{{ $inputId }}_mileage', mileage ?
                        `${new Intl.NumberFormat('ru-RU').format(mileage)} км` : '',
                        '{{ $inputId }}_mileage_container');
                    updateField('{{ $inputId }}_color', color, '{{ $inputId }}_color_container');
                    updateField('{{ $inputId }}_engine_type', engineType,
                        '{{ $inputId }}_engine_type_container');
                    updateField('{{ $inputId }}_transmission_type', transmissionType,
                        '{{ $inputId }}_transmission_type_container');
                    updateField('{{ $inputId }}_drive_type', driveType,
                        '{{ $inputId }}_drive_type_container');
                    updateField('{{ $inputId }}_body_type', bodyType,
                        '{{ $inputId }}_body_type_container');
                    updateField('{{ $inputId }}_vin', vin, '{{ $inputId }}_vin_container');
                    updateField('{{ $inputId }}_purchase_price', purchasePrice,
                        '{{ $inputId }}_purchase_price_container');
                    updateField('{{ $inputId }}_sell_price', sellPrice,
                        '{{ $inputId }}_sell_price_container');
                    // Show car info card
                    $('#{{ $inputId }}_info').show();
                } else {
                    // Hide car info card if no car is selected
                    $('#{{ $inputId }}_info').hide();
                }
            }

            function updateField(elementId, value, containerId) {
                // Convert value to string if it exists, or empty string if it doesn't
                const stringValue = value !== null && value !== undefined ? String(value) : '';

                if (stringValue && stringValue.trim() !== '') {
                    $(`#${elementId}`).text(stringValue);
                    $(`#${containerId}`).show();
                } else {
                    $(`#${containerId}`).hide();
                }
            }
        });
    </script>
@endpush
