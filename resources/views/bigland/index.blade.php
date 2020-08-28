@extends('layouts.app')

@section('content')

    <div>&nbsp;</div>

<form method="POST" action="/bigland">
    @csrf
    Получить номера
<input type="text" name="numbers" value="{{$numbers}}" style="width:100%">
<input type="submit" value="Получить данные">
</form>


@grid([
'dataProvider' => $provider,
'showFilters' => false,
'columns' => [
'cn' => ['title' => 'Cadastral Number', 'value' => 'cn'],
'address',
'price',
'area'
]
])



@endsection

