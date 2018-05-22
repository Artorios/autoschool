@extends('layouts.autoschool')
@section('content')
    <div class="content error lessons exam">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Экзамены</li>
            </ul>
        </div>
        <div class="lessons-wrapper exam-wrapper">
            <div class="title">
                <span class="number">№</span>
                <span class="name">Название</span>
                <span class="result">Результат</span>
                <span>Дата</span>
            </div>
            <?php $key_exam = 0; ?>
            @if($exams->count() > 0)
                @foreach($exams as $exam)
                    <div class="line">
                    <span class="name"><span class="number">{{++$key_exam+($exams->currentPage()-1)*8}}</span>
                        @if($exam->type == "test")
                            <a>Пробный экзамен</a>
                        @elseif($exam->type == "school")
                            <a>Школьный экзамен</a>
                        @endif
                    </span>
                        @if($all_number[$exam->id] == $correct_number[$exam->id] && $all_number[$exam->id] != 0)
                            <span class="result green">{{$correct_number[$exam->id]}} из {{$all_number[$exam->id]}}
                                <a><span class="refresh"></span></a></span>
                        @else
                            <span class="result">{{$correct_number[$exam->id]}} из {{$all_number[$exam->id]}}
                                <a><span class="refresh"></span></a></span>
                        @endif
                        <?php
                        $date = explode(' ', $exam->updated_at);
                        $date = explode('-', $date[0]);
                        ?>
                        <span class="date">{{$date[2].'.'.$date[1].'.'.$date[0]}}</span>
                    </div>
                @endforeach
            @else
                <h2>Еще не пройдено ни одного екзамена</h2>
            @endif
        </div>
        <nav aria-label="Page navigation example">
            <pages :page="{{json_encode($exams->currentPage())}}"
                   :pages="{{json_encode($exams->total())}}"
                   :total="{{json_encode($exams->perPage())}}"></pages>
        </nav>
    </div>
@endsection