(jQuery(function($) {
  var audio;
  var playlist;
  var tracks;
  var current;

  init();
  function init(){
    current = 0;
    audio = $('#audio-player');
    playlist = $('#playlist');
    tracks = playlist.find('li a');
    len = tracks.length - 1;

    playlist.find('a').click(function(e){
      e.preventDefault();
      link = $(this);
      current = link.parent().index();
      run(link, audio[0]);
    });

    audio[0].addEventListener('ended',function(e){
      current++;
      if(current == len){
        current = 0;
        link = playlist.find('a')[0];
      }else{
        link = playlist.find('a')[current];
      }
      run($(link),audio[0]);
    });
  }

  function run(link, player){
    player.src = link.attr('href');
    par = link.parent();
    par.addClass('active-track').siblings().removeClass('active-track');
    $('#playlist span').addClass('no-visible');
    current = par.find('span').removeClass('no-visible');
    audio[0].load();
    audio[0].play();
  }
}));
