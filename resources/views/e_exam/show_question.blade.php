<h2 class="ui center aligned dividing green header"><span>جميع الأسئلة المتعلقه بهذا الدرس وعددها</span>{{'(' . count($lesson->EExamQuestion) . ')'}}</h2>

@if(count($lesson->EExamQuestion) > 0)
    <div class="ui right aligned grid">
        @foreach($lesson->EExamQuestion as $question)
            <div class="eight wide column">
                <div class="ui teal segment">
                    <h3 class="ui header">
                        <span>السؤال:- </span>
                        {{$question->Question}}
                    </h3>

                    <h3 class="ui header"><span style="padding-bottom: 1px; border-bottom: 2px green solid;">الأختيارات</span></h3>
                    <?php $i = 0; ?>
                    @foreach ($question->options as $option)
                        <h2 class="ui sub header">
                            <div class="ui teal circular label">{{++$i}}</div>
                            {{$option->Option}}
                        </h2>
                    @endforeach
                    <h3 class="ui header">
                        <span>الأجابة الصحيحة هي:- </span>
                        {{$question->Answer}}
                    </h3>
                    <form class="ui form" method="post" action="/e-exam/question/delete">
                        {!! csrf_field() !!}
                        <input type="hidden" name="lessonID" value="{{$question->Lesson_ID}}">
                        <input type="hidden" name="questionID" value="{{$question->ID}}">
                        <button type="submit" class="ui fluid green button">حذف السؤال</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="ui one column grid">
        <div class="column">
            <div class="ui info big message">
                <div class="md-space"></div>
                <h3 class="ui center aligned header">لا توجد اسئلة حول هذا الدرس !!!</h3>
                <div class="md-space"></div>
            </div>
        </div>
    </div>
@endif






