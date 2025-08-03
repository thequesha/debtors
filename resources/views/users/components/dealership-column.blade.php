<div class="">
    @foreach ($user->dealerships as $dealership)
        <span class="badge mb-1 badge-primary">{{ $dealership->name }}</span>
    @endforeach

</div>
{{-- <p class="MsoNormal" style="text-align: left;"><span style="font-family: Calibri;">Вёрстка страницы (формы)
        «добавления/редактирования пользователя»</span>:<br>Заголовок "Добавить пользователя" расположен по
    центру<br>Блок с названием(подзаголовком) "Персональная информация" расположен по центру.<br><span
        style="font-family: Calibri;">Фотография под фотографией кнопка "загрузить фотографию", под кнопкой располагаются
        поля в колонку Фамилия*<em>, </em>Имя*, Отчество</span><span style="font-family: Calibri;">. </span>(Тип
    данных:&nbsp;<span style="font-family: Calibri;">строка Длина</span>: 120 <span style="font-family: Calibri;">симв
        Ограничение на ввод</span>: <span style="font-family: Calibri;">спец символы, формулы, Обязательное для ввода
        Фамилия и Имя) Под&nbsp; ФИО располагаются поля в колонку:<br></span><span style="font-family: Calibri;">Дата
        рождения (дд/мм/гггг) (При клике – календарь)<br></span><span style="font-family: Calibri;">Автосалон -
        выпадающий список (выбор автосалона и значение "добавить автосалон" при клике на который открывается форма
        добавления автосалона )<br></span><span style="font-family: Calibri;">Телефон (маска
        +7_</span>XXX_XXX_XX_XX).<br>В строку располагаются поля <span style="font-family: Calibri;">Логин*(Тип данных:
        строка Длина: 50 симв Ограничение на ввод: спец символы, формулы, только латиница),<br></span><span
        style="font-family: Calibri;">Пароль*(Тип данных: строка Длина: 50 симв Ограничение на ввод: спец символы,
        формулы,только латиница, мин длина пароля 8 симв)<br></span><span style="font-family: Calibri;">Должность -
        выпадающий список со значениями (Администратор, МОП, МОЗ, Ст.МОЗ, СтМОП, РОП, РОЗ, РКСО, КСС, Бухгалтер, Кассир,
        Техник-логист, Директор, Маркетолог)<br></span>С<span style="font-family: Calibri;">остояние</span>&nbsp;<span
        style="font-family: Calibri;">пользователя выпадающий список со значениями</span>(<span
        style="font-family: Calibri;">Работает, Уволен</span>)</p> --}}
