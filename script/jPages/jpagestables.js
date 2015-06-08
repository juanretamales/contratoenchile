//div.holder es el div donde estara el control de la tabla
//containerID es la id de tbody
$(function(){
    $(".holder").jPages({
      containerID : "contenidos",
      previous : "<-",
      next : "->",
      perPage : 20,
      delay : 20
    });
  });