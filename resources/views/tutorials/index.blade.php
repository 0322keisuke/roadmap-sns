@extends('app')

@section('title', '学習中の教材')

@section('content')
@include('nav')
<div class="container">
  <tutorial-task :initial-tutorials='@json($tutorials)' :initial-tasks='@json($tasks)' :initial-tutorial-id='@json($first_tutorial_id)'>
  </tutorial-task>

  <!-- <tutorial
    :initial-tutorials='@json($tutorials)'
    >
    </tutorial>

    <task
    :initial-tasks='@json($tasks)'
    >
    </task>   -->
</div>
@endsection