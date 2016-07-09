app.controller('ImageCtrl', function ($scope, $http) {
  console.log('ImageCtrl was started');

  $scope.images = '';
  $scope.file = {} //Модель
  $scope.options = {
    //Вызывается для каждого выбранного файла
    change: function (file) {
      //В file содержится информация о файле
      //Загружаем на сервер
      file.$upload('/image', $scope.file, {allowedType: ["jpeg", "jpg", "png", "gif"]})
        .then(function (response) {
          if (response.data.status == "OK") {
              $scope.msg = '';
              getImages();
          }
        })
        .catch(function (data) {
          $scope.msg = data.response[0].msg;
          return;
      })
    }

  }

  $scope.reload = function (file) {
    getImages();
  }

  $scope.clear = function () {
    $http.get("/clear")
      .success(function () {
        getImages();
      })
  }

  $scope.delete = function (image) {
    console.log(image);
    $http.delete("/image/" + image.id)
      .success(function () {
        getImages();
      })
  }

  getImages = function () {
    $http.get('/image')
      .success(function (data) {
          $scope.images = data.images;
      })
      // По хорошему здесть нужно отловить ошибку .error(function)
  }



  getImages();
})
