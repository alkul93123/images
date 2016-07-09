@extends('layout.main')
@section('scripts')
    <script src="{{ asset('js/images.js')}}" charset="utf-8"></script>
@stop
@section('content')
<div class="container" ng-controller='ImageCtrl'>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <h2>Работа с изображениями</h2>
    </div>
    <div class="col-lg-12 col-md-12">
      <form class="form-inline">
        <div class="form-group">
          <label>Выберите файл: </label>
          <input type="file" class="form-control" oi-file="options" ng-model="files">
        </div>
        <div class="form-group">
          <button type="button" class="btn btn-info" ng-click="reload()">Обновить данные</button>
        </div>
        <div class="form-group">
          <button type="button" class="btn btn-danger" ng-click="clear()">Очистить хранилище</button>
        </div>
      </form>
      <div class="col-lg-12 col-mg-12"  style="margin-top: 1%;">
        <label style='color:green'>Поддерживается формат jpg, png, gif</label>
      </div>
      <div class="col-lg-12 col-mg-12"  style="margin-top: 1%;">
        <label style='color:red'>@{{ msg }}</label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="col-lg-3 col-md-3 text-center" style='margin-top: 5%;' ng-repeat="image in images">
        <img src="@{{ image.href }}" alt="" />
        <div class="row" style="margin-top:5%;">
          <div class="col-lg-6 col-md-6">
            <label>@{{ image.name }}</label>
          </div>
          <div class="col-lg-6 col-md-6">
            <button type="button" class="btn btn-danger" ng-click="delete(image)">Удалить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
