let button = document.querySelector(".hero__timer-unlock");

button.addEventListener("click", () => {

  (async () => {
    try {
      const send = { clickTime: Date.now() };
      const init = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(send),
      };
      const response = await fetch("../app/php/clickupdate.php", init);
      if (response.ok) {
        var responseData = await response.json();
        console.log(responseData.message);
      } else {
        throw new Error(response.statusText);
      }
    } catch (err) {
      console.error(err);
    }
  })();
  window.location.href = "index.php?view=openCard";

});
