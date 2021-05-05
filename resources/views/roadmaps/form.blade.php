@csrf
<div class="md-form">
  <label for="title">ロードマップ名</label>
  <input type="text" name="title" id="title" class="form-control" value="{{ $roadmap->title ?? old('title') }}" {{ str_contains(url()->current(), 'create') ? '' : 'disabled' }}>
</div>

<label> 教材名/タスク名 </label>
@if($lists ?? '')
<roadmap-tutorial :initial-lists='@json($lists)' :old="{{ json_encode(Session::getOldInput() !== [] ? Session::getOldInput() : new stdClass ) }}" :authorized='@json(Auth::check())'></roadmap-tutorial>

@else
<roadmap-tutorial :old="{{ json_encode(Session::getOldInput() !== [] ? Session::getOldInput() : new stdClass ) }}" :editable='@json(true)'></roadmap-tutorial>
@endif

<div class=" form-group">
  <label></label>
  <textarea name="body" class="form-control" rows="8" placeholder="説明" {{ str_contains(url()->current(), 'create') ? '' : 'disabled' }}>{{ $roadmap->body ?? old('body') }}</textarea>
</div>

<div class="form-group">
  <roadmap-tags-input>
  </roadmap-tags-input>
</div>

<div class="md-form">
  <label for="estimated_time">学習時間目安(単位：時間)</label>
  <input type="number" name="estimated_time" id="estimated_time" class="form-control" value="{{ $roadmap->estimated_time ?? old('estimated_time') }}" min="1" max="300" {{ str_contains(url()->current(), 'create') ? '' : 'disabled' }}>
</div>

@if(str_contains(url()->current(),'create'))
<div class="form-group">
  <label>学習レベル</label>
  <select name="level" class="form-control" value="{{ $roadmap->level ?? old('level') }}">
    <option value="1">初級</option>
    <option value="2">中級</option>
    <option value="3">上級</option>
  </select>
  @else
  <label>学習レベル</label>
  <h6 class="border-bottom"><strong>{{ $roadmap->level_text }}</h6>
  @endif

</div>