@extends('app')

@section('title', '学習中の教材')

@section('content')
@include('nav')
<div class="container">
  @if($first_tutorial_id ?? '')
  <tutorial-task :initial-tutorials='@json($tutorials)' :initial-tasks='@json($tasks)' :initial-tutorial-id='@json($first_tutorial_id)'>
  </tutorial-task>
  @else
  <tutorial-task :initial-tutorials='@json($tutorials)' :initial-tasks='@json($tasks)'>
  </tutorial-task>
  @endif
</div>
@endsection