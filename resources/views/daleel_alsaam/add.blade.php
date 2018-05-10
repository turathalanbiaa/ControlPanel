@extends("layout.main_layout")

@section("title")
    <title> دليل الصائم </title>
@endsection

@section("content")

    <style>
        .ui.form .inline.field>label, .ui.form .inline.field>p, .ui.form .inline.fields .field>label, .ui.form .inline.fields .field>p, .ui.form .inline.fields>label{
            display: block!important;
        }
    </style>

    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>



        <div class="sixteen wide column">
            <a href="/daleel-alsaam" class="ui large blue button">الرئيسية</a>
            <div class="ui hidden divider"></div>
            <form class="ui form" action="/daleel-alsaam/create" method="post">

                {{csrf_field()}}

                <div class="inline fields">
                    <div class="field">
                        <label>المدينة</label>
                        <select name="city" required>
                            <option value="النجف">النجف</option>
                            <option value="بغداد">بغداد</option>
                            <option value="كربلاء">كربلاء</option>
                            <option value="البصرة">البصرة</option>
                            <option value="ذي قار">ذي قار</option>
                            <option value="القادسية">القادسية</option>
                            <option value="ميسان">ميسان</option>
                            <option value="واسط">واسط</option>
                            <option value="بابل">بابل</option>
                            <option value="ديالى">ديالى</option>
                            <option value="الانبار">الانبار</option>
                            <option value="صلاح الدين">صلاح الدين</option>
                            <option value="الموصل">الموصل</option>
                            <option value="ديالى">ديالى</option>
                            <option value="السبت">كركوك</option>
                            <option value="السليمانية">السليمانية</option>
                            <option value="اربيل">اربيل</option>
                            <option value="دهوك">دهوك</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>اليوم</label>
                        <select name="day" required>
                            <option value="الاحد">الاحد</option>
                            <option value="الاثنين">الاثنين</option>
                            <option value="الثلاثاء">الثلاثاء</option>
                            <option value="الاربعاء">الاربعاء</option>
                            <option value="الخميس">الخميس</option>
                            <option value="الجمعة">الجمعة</option>
                            <option value="السبت">السبت</option>
                        </select>
                    </div>
                </div>

                <div class="inline fields">
                    <div class="field">
                        <label>يوم رمضان</label>
                        <input type="number" name="ramadanDay" required>
                    </div>

                    <div class="field">
                        <label>الشهر الميلادي</label>
                        <input type="number" name="monthOfYear" required>
                    </div>

                    <div class="field">
                        <label>اليوم بالشهر الميلادي</label>
                        <input type="number" name="dayOfMonth" required>
                    </div>
                </div>

                <div class="inline fields">

                    <div class="field">
                        <label>الامساك</label>
                        <input placeholder="مثلا : 07:12" type="text" name="imsak" required>
                    </div>

                    <div class="field">
                        <label>الضهر</label>
                        <input placeholder="مثلا : 07:12" type="text" name="duhr" required>
                    </div>

                    <div class="field">
                        <label>الفجر</label>
                        <input placeholder="مثلا : 07:12" type="text" name="fajir" required>
                    </div>

                    <div class="field">
                        <label>المغرب</label>
                        <input placeholder="مثلا : 07:12" type="text" name="mogrhib" required>
                    </div>
                </div>

                <button style="min-width: 140px;" class="ui large green button">حفظ</button>

            </form>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });
    </script>
@endsection