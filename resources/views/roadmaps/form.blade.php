@csrf
<div class="md-form">
  <label for="title">ロードマップ名</label>
  <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
</div>

<label> 教材名/タスク名 </label>
<roadmap-tutorial :old="{{ json_encode(Session::getOldInput() !== [] ? Session::getOldInput() : new stdClass ) }}"></roadmap-tutorial>

<div class="form-group">
  <label></label>
  <textarea name="body" class="form-control" rows="8" placeholder="説明">{{ old('body') }}</textarea>
</div>

<div class="md-form">
  <label for="estimated_time">学習時間目安(単位：時間)</label>
  <input type="number" name="estimated_time" id="estimated_time" class="form-control" value="{{ old('estimated_time') }}" min="1" max="300">
</div>

<div class="form-group">
  <label>学習レベル</label>
  <select name="level" class="form-control" value="{{ old('level') }}">
    <option value="1">初級</option>
    <option value="2">中級</option>
    <option value="3">上級</option>
  </select>
</div>