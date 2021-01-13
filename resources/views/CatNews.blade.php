@extends('main')

@section('content')
<div class="content">
    <h3> Последние новости </h3>

    <table>

    <tr><td>
    @foreach($news as $oneNews)
    <div class="NewsBlock">
        <div> {{ $oneNews->body }} </div><br>
        <div> {{ $oneNews->created_at }} </div>
    </div><br>
    @endforeach
    </td></tr>
    
    </table>

</div>
@endsection
