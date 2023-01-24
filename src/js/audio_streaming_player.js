/**
 * Audio Streaming Player.
 */

(function ($) {
  // "use strict";
  $(".jp-pause").hide();
  const stream = document.createElement("audio");

  Drupal.behaviors.audiostreamingplayer = {
    attach: function (context, settings) {
      let url_streaming = settings.data_value_field["url"];
      let autoplay = settings.data_value_field["autoplay"];


      stream.setAttribute("data-playlist", url_streaming);
      stream.id = "stream";
      stream.controls = true;

      // Return true or false from autoplay
      function autoPlaying(auto) {
        var flag = false;
        if (auto == 1) {
          flag = true;
        } else {
          flag = false;
        }
        return flag;
      }



      m3uStreamPlayer.ready(stream);
      stream.autoplay = false;

      // Function Turn up audio or video volume
      function incrementVolume() {
        let currentVolume = stream.volume;
        if (currentVolume < 1) {
          stream.volume = currentVolume + 0.1;
        }
      }

      // Function Low audio or video volume
      function decrementVolume() {
        let currentVolume = stream.volume;
        if (currentVolume > 0) {
          stream.volume = currentVolume - 0.1;
        }
      }
      // Play audio playback. // Play audio playback.
      $(".jp-play", context).click(function () {
        stream.play();
        $(".jp-play").hide();
        $(".jp-pause").show();
        $(".jp-title").html("Playing");
      });
      // Pause audio playback. // Pause audio playback.
      $(".jp-pause", context).click(function () {
        stream.pause();
        $(".jp-play").show();
        $(".jp-pause").hide();
        $(".jp-title").html("Click Play to start listening");
      });

      // Turn up the audio or video volume
      $(".jp-volume-max", context).click(function () {
        incrementVolume();
        $(".jp-volume-bar-value").css("width", stream.volume * 100 + "%");
      });
      // Low audio or video volume
      $(".jp-unmute", context).click(function () {
        decrementVolume();
        $(".jp-volume-bar-value").css("width", stream.volume * 100 + "%");
      });

      $(".jp-mute", context).click(function () {
        decrementVolume();
        $(".jp-volume-bar-value").css("width", stream.volume * 100 + "%");
      });
    },
  };
})(jQuery);
