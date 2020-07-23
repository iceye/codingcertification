/*
 * Show a allert on the page
 * Params:
 *  text: text to show
 *  options: object that can override the following options
 *    type: alert will have class 'alert-color'. Default null
 *    duration: duration of the notification in ms. Default 2000ms
 *    container-id: id of the alert container. Default 'body'
 */
function allert(text, options) {
  console.log(text,options);
    var defaultOptions = {
      type: null,
      align: "default-position",
      duration: 2000, // duration of the notification in ms
      "container-id": "body", // id of the alert container
    };
  
    options = typeof options === "object" ? options : defaultOptions;
  
    // set options
    for (var propertyName in defaultOptions) {
      if (defaultOptions.hasOwnProperty(propertyName)) {
        if (
          options[propertyName] === undefined ||
          options[propertyName] === null ||
          options[propertyName] === ""
        ) {
          options[propertyName] = defaultOptions[propertyName];
        }
      }
    }
  
    var container =
      options["container-id"] === "body"
        ? document.getElementsByTagName("body")[0]
        : document.getElementById(options["container-id"]);
  
    var typeMarkup = "";

    if (options.type) {
      typeMarkup = "allert-" + options.type;
    }
  
    // Generate the HTML
    var element = document.createElement("div");
  
      element.setAttribute(
      "class",
      "allert allert-" + options.align + " " + typeMarkup
    );

    console.log(element);
    console.log(options.align);

    element.setAttribute("title", text);
  
    element.innerHTML = text;
  
    container.appendChild(element);

    var close = function (element) {
      element.classList.add("allert-fadeout");
  
      // after the fadeout remove the element from DOM
      setTimeout(function () {
        element.remove();
      }, 1000);
    };
  
    // Remove allert on click
    element.addEventListener("click", function () {
      close(this);
    });
  
    // After 'duration' seconds, remove allert
    setTimeout(function () {
      close(element);
    }, options.duration);
  }
  