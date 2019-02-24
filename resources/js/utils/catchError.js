import Noty from "noty";
import _ from "lodash";
export default e => {
  if (e.response) {
    const status = e.response.status;
    let message = "";
    if (e.response.data && e.response.data)
      message = e.response.data.message;
    switch (status) {
      case 400:
        showNoty(message, "error");
        break;
      case 422:
        {
          const {
            errors
          } = e.response.data;
          _.forEach(errors, (value, key) => {
            showNoty(_.trim(value), "error");
          });
        }
        break;
      case 401:
        {
          console.log("401"); //eslint-disable-line
        }
        break;

      case 403:
        showNoty(message, "error");
        break;

      default:
        showNoty(
          "Internal Server Error, please contact our Administrator",
          "error"
        );
        console.log("Unknown Status"); //eslint-disable-line
        break;
    }
  } else {
    console.log("default error"); //eslint-disable-line
    showNoty(
      "Internal Server Error, please contact our Administrator",
      "error"
    );
  }
};

export function showNoty(text, type) {
  return new Noty({
    layout: "topRight",
    text,
    theme: "metroui",
    timeout: 5000,
    progressBar: true,
    type
  }).show();
}
