@extends("layout.main_layout")

@section("title")
    <title> المستمسكات </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui segment">
                <div class="ui center aligned three column grid">
                    <div class="column">1</div>
                    <div class="column">2</div>
                    <div class="column">3</div>
                </div>
            </div>
        </div>
    </div>
@endsection