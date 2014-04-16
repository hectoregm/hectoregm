function dragStart(event) {
  event.dataTransfer.effectAllowed='move';
  event.dataTransfer.setData("Text", event.target.getAttribute('id'));
  event.dataTransfer.setDragImage(event.target,100,100);
  return true;
}

function dragEnter (event) {
   event.preventDefault();
   return true;
}

function dragDrop(event) {
   var data = event.dataTransfer.getData("Text");
   event.target.appendChild(document.getElementById(data));
   ev.stopPropagation();
   return false;
}

function dragOver (event) {
   event.preventDefault();
   return true;
}

jQuery(function($) {
  $('#box').on('dragstart', function(event) {
    return dragStart(event.originalEvent);
  });

  $('.sectionA, .sectionB').on('dragenter',function(event) {
    return dragEnter(event.originalEvent);
  })

  $('.sectionA, .sectionB').on('drop',function(event) {
    return dragDrop(event.originalEvent);
  })

  $('.sectionA, .sectionB').on('dragover',function(event) {
    return dragOver(event.originalEvent);
  })
});
