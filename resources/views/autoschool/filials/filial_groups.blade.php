@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Филиал</li>
            </ul>
        </div>
        <block-statistic-groups></block-statistic-groups>
        <div class="blockgroupe">
            <h2>Группы:</h2>
            <div class="table-wrapper">
                <div class="title-line">
                    <span class="number">№</span>
                    <span class="name">Название группы</span>
                    <span class="data-and-time">Дата и время экзамена</span>
                    <span class="count">Кол-во учеников</span>
                </div>
                @foreach($groups[0] as $group)
                <div class="line">
                    <div class="number">{{$group->id}}</div>
                    <div class="name"><a href="#">{{$group->name}}</a></div>
                    <div class="data-and-time">
                        <img src="img/clock.png"> {{$group->exam_date}} {{$group->exam_time}}
                    </div>
                    <div class="count">
                        <span class="visible-xs hidden-sm">Количество учеников  8</span>
                        <span class="visible-sm hidden-xs visible-lg visible-md">{{$group->student_counts}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="invitegroupe">
            <ul class="pagination">
                <li class="page-item">
                    {{--<a :class="[{active: currentPage === 1}, 'page-link']" href="#">1</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">2</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">3</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">4</a>--}}
                </li>
            </ul>
        </div>
        <button-add-group></button-add-group>
    </div>

@endsection
<script>
    import AddGroup from "../../../assets/js/AutoschoolComponent/group";
    export default {
        components: {
            AddGroup
        }
    }
</script>

<style>
    header{
        overflow: hidden;
    }
</style>