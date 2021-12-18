var demo1 = new Moovie({
  selector: "#example",
  dimensions: {
    width: "100%"
  },
  config: {
    storage: {
      captionOffset: false,
      playrateSpeed: false,
      captionSize: false
    },
    controls: {
      playtime: false,
      volume: false,
      subtitles: false,
      fullscreen: false,
      submenuCaptions : true,
      submenuOffset : false,
      allowLocalSubtitles : false  
    }
  },
  icons: {
        path: "https://raw.githubusercontent.com/BMSVieira/moovie.js/main/icons/"
  }
});