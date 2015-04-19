$(function(){
  var ButtonStack = (function(){
    var root,
        buttons = [1, 2, 3];

    function clicked(e){
      buttons.push(buttons.shift());
      render(root);
    }

    function render(node){
      root = node;
      root.empty();
      for(var i in buttons){
        var button = $('<input type="button" class="task5_button" value="' + buttons[i] + '"/>');
        button.on('click', clicked);
        root.append(button);
      }
    }

    return {
      render: render
    };
  })();

  ButtonStack.render($('#task5_box'));
});
